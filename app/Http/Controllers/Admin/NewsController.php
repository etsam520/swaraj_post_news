<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsGallery;
use App\Models\State;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;

    use Intervention\Image\ImageManager;

class NewsController extends Controller
{
    public function index()
    {
        $user = auth('admin')->user();
        $roles = $user->getRoleNames();

        $news = News::with('translations')
            ->when($roles->contains('reporter'), function ($query) use ($user) {
                $query->where('created_by', $user->id)->latest();
            })
            ->whereNotIn('status', ['draft'])
            ->latest() // Ensuring `latest()` is always applied
            ->get();

        return view('admin.news._table', compact('news'));
    }
    public function draft()
    {
        $user = auth('admin')->user();

        $news = News::with('translations')
            ->whereIn('status', ['draft'])
            ->latest() // Ensuring `latest()` is always applied
            ->get();

        return view('admin.news._table', compact('news'));
    }

    public function add()
    {
        $tags = Tag::with('translations')->get();
        $categories = Category::with('translations')->get();

        $states = State::with('translations', 'cities.translations')->get();

        return view('admin.news._add', compact('tags', 'categories', 'states'));
    }

    public function show($locale, $slug)
    {
       $news = News::whereTranslation('slug', $slug, $locale)
       ->select('news.*')
        ->with(['creator:id,name','gallery:id,image_path,news_id'])
        ->join('category_translations', function ($join) use ($locale) {
            $join->on('news.category_id', '=', 'category_translations.category_id')
                ->where('category_translations.locale', '=', $locale);
        })
        ->join('cities', 'news.city_id', '=', 'cities.id')
        ->join('city_translations', function ($join) use ($locale) {
            $join->on('cities.id', '=', 'city_translations.city_id')
                ->where('city_translations.locale', '=', $locale);
        })
        ->leftJoin('states', 'cities.state_id', '=', 'states.id')
        ->leftJoin('state_translations', function ($join) use ($locale) {
            $join->on('states.id', '=', 'state_translations.state_id')
                ->where('state_translations.locale', '=', $locale);
        })
        ->addSelect(
            'city_translations.city_name as city_name',
            'state_translations.state_name as state_name',
            'category_translations.category_name'
        )
        ->firstOrFail();

        return view('admin.news._detailed-view', compact('news', 'locale'));
    }

    public function store(Request $request)
    {
        $rules = [
            'headline_en' => 'required|string|max:255',
            'headline_hi' => 'required|string|max:255',
            'quote_en'    => 'nullable|string|max:255',
            'quote_hi'    => 'nullable|string|max:255',
            'category'    => 'nullable|exists:categories,id',
            'city'        => 'nullable|exists:cities,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'details_en'  => 'required|string',
            'details_hi'  => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'news_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'video_url'   => 'nullable|url',
        ];

        $messages = [
            'required' => ':attribute is required',
            'max'      => ':attribute must not exceed :max characters',
            'mimes'    => ':attribute must be a valid image (jpeg, png)',
        ];

        $attributes = [
            'headline_en' => 'English Headline',
            'headline_hi' => 'Hindi Headline',
            'category'    => 'Category',
            'city'        => 'City',
            'details_en'  => 'English Details',
            'details_hi'  => 'Hindi Details',
            'news_photo'  => 'News Photo',
            'video_url'   => 'Video URL',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Proceed with saving data
        $this->saveNews($request);
        $this->clearNewsCaches(); // clearing cache

        return redirect()->route('admin.news.index')
                        ->with('success', 'News saved successfully.');
    }




    private function saveNews($request)
    {
        $imageManager = new ImageManager( new Driver()); // Fix: Pass driver config

        // 1. Thumbnail - lower quality
        $thumbnail = $imageManager->read($request->file('thumbnail')->getPathname())
            ->scale(width: 400)
            ->toJpeg(quality: 60);

        $thumbnailPath = env('UPLOADS_DIR').'news/thumbnails/' . uniqid() . '.jpg';
        Storage::disk('s3')->put($thumbnailPath, $thumbnail->toString(), 'public');

        // 2. News image - medium quality
        $newsImage = $imageManager->read($request->file('news_image')->getPathname())
            ->scale(width: 1200)
            ->toJpeg(quality: 75);

        $newsImagePath = env('UPLOADS_DIR').'news/images/' . uniqid() . '.jpg';
        Storage::disk('s3')->put($newsImagePath, $newsImage->toString(), 'public');

        // 3. Prepare data
        $data = [
            'category_id' => $request->category,
            'city_id'     => $request->city,
            'status'      => $request->publish ? "publish" : ($request->save_as_draft ? "draft" : ($request->save ? "pending" : "null")),
            'created_by'  => auth('admin')->user()->id,
            'is_draft'    => $request->save_as_draft ? true : false,
            'thumbnail'   => $thumbnailPath,
            'tags'        => $request->input('tags'),
            'image'       => $newsImagePath,
            'video_link'  => $request->video_url,
        ];

        if ($data['status'] === "publish") {
            $data['approved_at'] = now();
            $data['approved_by'] = auth('admin')->user()->id;
        }

        $news = News::create($data);

        $news->translations()->createMany([
            [
                'locale'    => 'en',
                'headline'  => $request->headline_en,
                'quote'     => $request->quote_en,
                'details'   => $request->details_en,
                'slug'      => Str::slug($request->headline_en),
            ],
            [
                'locale'    => 'hi',
                'headline'  => $request->headline_hi,
                'quote'     => $request->quote_hi,
                'details'   => $request->details_hi,
                'slug'      => Str::slug($request->headline_hi),
            ],
        ]);

        // 4. Gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $optimized = $imageManager->read($galleryImage->getPathname())
                    ->scale(width: 1000)
                    ->toJpeg(quality: 70);

                $galleryPath = env('UPLOADS_DIR').'news/gallery/' . uniqid() . '.jpg';
                Storage::disk('s3')->put($galleryPath, $optimized->toString(), 'public');

                NewsGallery::create([
                    'news_id'    => $news->id,
                    'image_path' => $galleryPath,
                ]);
            }
        }
    }


    public function changeStatus(Request $request,$id, $status) {
        // dd([$status, $id]);
        $news = News::findOrFail($id);
        $news->status = $status??'pending';
        $news->approved_by = auth('admin')->user()->id;
        $news->approved_at = now();
        if($news->status == "publish"){
            $news->publish_at = now();
        }
        $news->save();
        $this->clearNewsCaches(); // clearing cache
        return back()->with('success', 'Status Updated');
    }

    public function edit($id)
    {
        $news = News::with('translations')
                ->leftJoin('cities', 'news.city_id', '=', 'cities.id')
                ->leftjoin('states', 'cities.state_id', '=', 'states.id')
                ->select('news.*', 'cities.id as city_id', 'states.id as state_id')
                ->findOrFail($id);
        $categories = Category::all();
        $states = State::with('translations', 'cities.translations')->get();
        $tags = Tag::all();

        return view('admin.news._edit', compact('news', 'categories', 'states', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'headline_en' => 'required|string|max:255',
            'headline_hi' => 'required|string|max:255',
            'quote_en'    => 'nullable|string|max:255',
            'quote_hi'    => 'nullable|string|max:255',
            'category'    => 'nullable|exists:categories,id',
            'city'        => 'nullable|exists:cities,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'details_en'  => 'required|string',
            'details_hi'  => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'news_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'video_url'   => 'nullable|url',
        ];

        $messages = [
            'required' => ':attribute is required',
            'max'      => ':attribute must not exceed :max characters',
            'mimes'    => ':attribute must be a valid image (jpeg, png)',
        ];

        $attributes = [
            'headline_en' => 'English Headline',
            'headline_hi' => 'Hindi Headline',
            'category'    => 'Category',
            'city'        => 'City',
            'details_en'  => 'English Details',
            'details_hi'  => 'Hindi Details',
            'news_photo'  => 'News Photo',
            'video_url'   => 'Video URL',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->updateNews($request, $id);
          $this->clearNewsCaches(); // clearing cache

        return redirect()->route('admin.news.index')
                        ->with('success', 'News updated successfully.');
    }

    private function __updateNews($request, $id)
    {
        $news = News::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            Storage::delete('public/news/thumbnails/' . $news->thumbnail);
            $thumbnailPath = $request->file('thumbnail')->store('public/news/thumbnails');
            $news->thumbnail = Str::after($thumbnailPath, 'public/');
        }

        if ($request->hasFile('news_image')) {
            // Delete old news image if exists
            Storage::delete('public/news/images/' . $news->image);
            $newsImagePath = $request->file('news_image')->store('public/news/images');
            $news->image = Str::after($newsImagePath, 'public/');
        }

        // Update news
        $news->category_id = $request->category;
        $news->city_id = $request->city;
        $news->status = $request->publish ? "publish" : ($request->save_as_draft ? "draft" : ($request->save ? "pending" : "null"));
        $news->tags = $request->input('tags');
        $news->video_link = $request->video_url;

        $news->save();

        // Update translations
        $news->translations()->updateOrCreate(
            ['locale' => 'en'],
            [
                'headline' => $request->headline_en,
                'quote'    => $request->quote_en,
                'details'  => $request->details_en,
                'slug'     => Str::slug($request->headline_en),
            ]
        );

        $news->translations()->updateOrCreate(
            ['locale' => 'hi'],
            [
                'headline' => $request->headline_hi,
                'quote'    => $request->quote_hi,
                'details'  => $request->details_hi,
                'slug'     => Str::slug($request->headline_hi),
            ]
        );

        // Update gallery
        if ($request->hasFile('gallery')) {
            // Delete old gallery images if necessary
            $news->gallery()->each(function($gallery) {
                Storage::delete('public/news/gallery/' . $gallery->image_path);
                $gallery->delete();
            });

            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPath = $galleryImage->store('public/news/gallery');
                NewsGallery::create([
                    'news_id' => $news->id,
                    'image_path' => Str::after($galleryPath, 'public/'),
                ]);
            }
        }
    }

    private function updateNews($request, $id)
    {
        $news = News::findOrFail($id);

        $imageManager = new ImageManager(new Driver()); // or 'imagick' if you prefer

        // Thumbnail
        if ($request->hasFile('thumbnail')) {
            // Delete old
            if ($news->thumbnail) {
                Storage::disk('s3')->delete($news->thumbnail);
            }

            $thumbnail = $imageManager->read($request->file('thumbnail'))->scale(width: 400)->toJpeg(quality: 60);
            $thumbnailPath = env('UPLOADS_DIR').'news/thumbnails/' . uniqid() . '.jpg';
            Storage::disk('s3')->put($thumbnailPath, (string) $thumbnail, 'public');
            $news->thumbnail = $thumbnailPath;
        }

        // News Image
        if ($request->hasFile('news_image')) {
            // Delete old
            if ($news->image) {
                Storage::disk('s3')->delete($news->image);
            }

            $newsImage = $imageManager->read($request->file('news_image'))->scale(width: 800)->toJpeg(quality: 70);
            $newsImagePath = env('UPLOADS_DIR').'news/images/' . uniqid() . '.jpg';
            Storage::disk('s3')->put($newsImagePath, (string) $newsImage, 'public');
            $news->image = $newsImagePath;
        }

        // Update core fields
        $news->category_id = $request->category;
        $news->city_id = $request->city;
        $news->status = $request->publish ? "publish" : ($request->save_as_draft ? "draft" : ($request->save ? "pending" : "null"));
        $news->tags = $request->input('tags');
        $news->video_link = $request->video_url;
        $news->save();

        // Translations
        $news->translations()->updateOrCreate(
            ['locale' => 'en'],
            [
                'headline' => $request->headline_en,
                'quote'    => $request->quote_en,
                'details'  => $request->details_en,
                'slug'     => Str::slug($request->headline_en),
            ]
        );

        $news->translations()->updateOrCreate(
            ['locale' => 'hi'],
            [
                'headline' => $request->headline_hi,
                'quote'    => $request->quote_hi,
                'details'  => $request->details_hi,
                'slug'     => Str::slug($request->headline_hi),
            ]
        );

        // Gallery
        if ($request->hasFile('gallery')) {
            // Delete old gallery images from S3
            $news->gallery()->each(function ($gallery) {
                Storage::disk('s3')->delete($gallery->image_path);
                $gallery->delete();
            });

            foreach ($request->file('gallery') as $galleryImageFile) {
                $galleryImage = $imageManager->read($galleryImageFile)->scale(width: 600)->toJpeg(quality: 65);
                $galleryPath = env('UPLOADS_DIR').'news/gallery/' . uniqid() . '.jpg';
                Storage::disk('s3')->put($galleryPath, (string) $galleryImage, 'public');

                NewsGallery::create([
                    'news_id' => $news->id,
                    'image_path' => $galleryPath,
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Delete thumbnail from S3 if exists
        if ($news->thumbnail) {
            Storage::disk('s3')->delete($news->thumbnail);
        }

        // Delete main news image from S3 if exists
        if ($news->image) {
            Storage::disk('s3')->delete($news->image);
        }

        // Delete gallery images from S3 and DB
        $news->gallery()->each(function ($gallery) {
            if ($gallery->image_path) {
                Storage::disk('s3')->delete($gallery->image_path);
            }
            $gallery->delete();
        });

        // Delete translations
        $news->translations()->delete();

        // Finally delete the news record
        $news->delete();
        $this->clearNewsCaches(); // clearing cache

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }

    protected function clearNewsCaches() : void
    {
       Cache::store('redis')->flush();
    }
    protected function x_clearNewsCaches()
    {
        $locales = ['en', 'hi']; // Add your supported locales here

        foreach ($locales as $locale) {
            // Static keys
            Cache::forget("live_video_news_{$locale}");
            Cache::forget("political_news_{$locale}");
            Cache::forget("categorised_news_{$locale}");

            // News lists - dynamic keys (approximate invalidation using Redis key scan)
            $pattern = "news_list_{$locale}_*";
            $this->forgetByPattern($pattern);

            $pattern = "top_news_slider_{$locale}_*";
            $this->forgetByPattern($pattern);

            $pattern = "news_details_{$locale}_*";
            $this->forgetByPattern($pattern);

            $pattern = "news_data_{$locale}_*";
            $this->forgetByPattern($pattern);

            $pattern = "category_news_{$locale}_*";
            $this->forgetByPattern($pattern);
        }
    }


    protected function forgetByPattern(string $pattern)
    {
        if (Cache::getStore() instanceof \Illuminate\Cache\RedisStore) {
            $redis = Cache::getRedis();
            $keys = $redis->keys(config('cache.prefix') . ':' . $pattern); // Add prefix if set

            foreach ($keys as $key) {
                $redis->del($key);
            }
        }
    }


}

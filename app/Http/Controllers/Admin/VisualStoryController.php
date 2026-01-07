<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Tag;
use App\Models\VisualStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VisualStoryController extends Controller
{
    public function index()
    {
        $user = auth('admin')->user();
        $roles = $user->getRoleNames();

        $visualStories = VisualStory::with('translations')
            ->when($roles->contains('reporter'), function ($query) use ($user) {
                $query->where('publishe_by', $user->id)->latest();
            })
            ->whereNotIn('status', ['draft'])
            ->latest() // Ensuring `latest()` is always applied
            ->get();

        return view('admin.visual-stories._table', compact('visualStories'));
    }

    public function draft()
    {
        $user = auth('admin')->user();

        $visualStories = VisualStory::with('translations')
            ->whereIn('status', ['draft'])
            ->latest() // Ensuring `latest()` is always applied
            ->get();
        // dd($visualStories);

        return view('admin.visual-stories._table', compact('visualStories'));
    }


    public function add()
    {
        $tags = Tag::with('translations')->get();
        $categories = Category::with('translations')->get();
        $cities = City::with('translations')->get();
        return view('admin.visual-stories._add', compact('tags', 'categories', 'cities'));
    }

    public function edit($id)
    {
        $visualStory = VisualStory::with('translations')->findOrFail($id);
        $cities = City::all();
        // dd($visualStory->translate('hi')->title);

        return view('admin.visual-stories._edit', compact('visualStory', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hi' => 'required|string|max:255',
            'city' => 'required|integer|exists:cities,id',
            'media' => 'required|array',
            'media.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:51200', // Allow images & videos, max 20MB
            'description_en' => 'required|string',
            'description_hi' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->saveStory($request);
        return redirect()->route('admin.visual-stories.index')
        ->with('success', 'Visual saved successfully.');
    }

    private function saveStory($request)
    {
        // dd($request->all());
        // 'draft', 'publish','pending','reject'
        $coverImage = $request->file('cover_image')->store('public/visual-story/cover_image');


        // ['', '','city_id', 'status','publishe_by]
        $visualStory = VisualStory::create([
            'city_id'     => $request->city,
            'status' => $request->publish ? "published" : ($request->save_as_draft ? "draft" : ($request->save ? "pending" : "null")),
            'is_draft' => $request->save_as_draft? true : false,
            'tags' => $request->input('tags'),
            'cover_image' => Str::after($coverImage, 'public/'),
        ]);

        $visualStory->slides()->createMany(
            collect($request->media)->map(function ($media) {
                $mediaPath = $media->store('public/visual-story/slides');
                return ['media' => Str::after($mediaPath, 'public/')];
            })->toArray()
        );

        $visualStory->translations()->createMany([
            [
                'locale'    => 'en',
                'title'  => $request->title_en,
                'description'   => $request->description_en,
                'slug' => Str::slug($request->title_en),
            ],
            [
                'locale'    => 'hi',
                'title'  => $request->title_hi,
                'description'   => $request->description_hi,
                'slug' => Str::slug($request->title_hi),
            ],
        ]);
    }

    public function show($id)
    {

        $visualStory = VisualStory::with(['slides'])->find($id)->toArray();

        return view('admin.visual-stories._detailed-view', compact('visualStory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hi' => 'required|string|max:255',
            'city' => 'required|integer|exists:cities,id',
            'video_url' => 'required|array',
            'video_url.*' => 'required|url',
            'description_en' => 'required|string',
            'description_hi' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:51200',
        ]);

        $this->updateViualStory($request, $id);

        return redirect()->route('admin.visual-stories.index')
                        ->with('success', 'Visual Story updated successfully.');
    }

    private function updateViualStory($request, $id)
    {
        $visualStory = VisualStory::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            // Delete old thumbnail if exists
            Storage::delete('public/' . $visualStory->cover_image);
            $coverImage = $request->file('cover_image')->store('public/visual-story/cover_image');
            $visualStory->cover_image = Str::after($coverImage, 'public/');
        }



        // Update news
        $visualStory->city_id = $request->city;
        $visualStory->status = $request->publish ? "publish" : ($request->save_as_draft ? "draft" : ($request->save ? "pending" : "null"));
        $visualStory->slides = json_encode($request->video_url);

        $visualStory->save();

        // Update translations
        $visualStory->translations()->updateOrCreate(
            ['locale' => 'en'],
            [
                'title'  => $request->title_en,
                'description'   => $request->description_en,
                'slug' => Str::slug($request->title_en),
            ]
        );

        $visualStory->translations()->updateOrCreate(
            ['locale' => 'hi'],
            [
                'title'  => $request->title_hi,
                'description'   => $request->description_hi,
                'slug' => Str::slug($request->title_hi),
            ]
        );

    }

    public function changeStatus(Request $request,$id, $status) {
        // dd([$status, $id]);
        $visualStory = VisualStory::findOrFail($id);
        $visualStory->status = $status??'draft';
        $visualStory->publishe_by = auth('admin')->user()->id;
        if($visualStory->status == "publish"){
            $visualStory->published_at = now();
        }
        $visualStory->save();
        return back()->with('success', 'Status Updated');
    }

    public function destroy($id)
    {
        // Find the news item by its ID
        $visualStory = VisualStory::findOrFail($id);

        // Delete the thumbnail image if it exists
        if ($visualStory->cover_image) {
            Storage::disk('public')->delete($visualStory->cover_image);
        }

        // Delete the news record from the database
        $visualStory->delete();

        // Redirect back with a success message
        return redirect()->route('admin.visual-stories.index')
                        ->with('success', 'Visual Story deleted successfully.');
    }
}

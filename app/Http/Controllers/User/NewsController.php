<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /*public function getNews(Request $request)
    {
        $locale = app()->getLocale(); // Get the current application locale
        $city_id = Session::has('city') ?  optional(Session::get('city'))->id : null;
        $q = $request->input('q', null);
        // Fetch news with translations based on the current locale
        $news = News::with(['translations' => function ($query) use ($locale, $q) {
            $query->where('locale', $locale);
        }])
            ->when($q != null, function ($query) use ($q) {
                $matchingTagIds = $this->getTagIdsBySearch($q);
                $query->whereHas('translations', function ($subQuery) use ($q) {
                    $subQuery->where('headline', 'like', "%$q%")
                        ->orWhere('quote', 'like', "%$q%")
                        ->orWhere('details', 'like', "%$q%")
                        ->orWhere('slug', 'like', "%$q%");
                });
                $query->orWhere(function ($subQuery) use ($matchingTagIds) {
                    foreach ($matchingTagIds as $tagId) {
                        $subQuery->orWhere('tags', 'like', '%"' . $tagId . '"%');
                    }
                });
            })
            // ->when($city_id != null , function ($query) use ($city_id) {
            //     $query->where('city_id', $city_id);
            // })
            ->isActive()
            ->latest()
            ->limit(20)
            ->get();

        return response()->json($news);
    }*/

    /*public function liveVideogetNews()
    {
        $news = News::with('translations')->isActive()->whereNotNull('video_link')->take(10)->get();
        return response()->json($news);
    }*/

    /*protected function getTagIdsBySearch($search)
    {
        $tags = Tag::WhereHas('translations', function ($query) use ($search) {
            $query->where('tag_name', 'like', "%$search%");
        })->get()->pluck('id')->toArray();
        return $tags;
    }*/


    /* public function political_news()
    {
        $locale = app()->getLocale(); // Get the current application locale

        // Fetch the "Politics" category based on the current locale
        $politicsCategory = Category::whereHas('translations', function ($query) use ($locale) {
            $query->where('locale', $locale)
                ->where('category_slug', 'politics');
        })->first();

        if (!$politicsCategory) {
            return response()->json(['message' => 'Politics category not found'], 404);
        }

        // Fetch news linked to the "Politics" category, including translations
        $news = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('category_id', $politicsCategory->id)
            ->isActive()
            ->take(4)
            ->latest()
            ->get();

        return response()->json($news);
    }*/

    /*public function top_news_slider(Request $request)
    {
        $q = $request->input('q', null);
        $news = News::with([
            'translations',
            'creator:id,name,email,phone_number'
        ])
            ->when($q != null, function ($query) use ($q) {
                $matchingTagIds = $this->getTagIdsBySearch($q);
                $query->whereHas('translations', function ($subQuery) use ($q) {
                    $subQuery->where('headline', 'like', "%$q%")
                        ->orWhere('quote', 'like', "%$q%")
                        ->orWhere('details', 'like', "%$q%")
                        ->orWhere('slug', 'like', "%$q%");
                });
                $query->orWhere(function ($subQuery) use ($matchingTagIds) {
                    foreach ($matchingTagIds as $tagId) {
                        $subQuery->orWhere('tags', 'like', '%"' . $tagId . '"%');
                    }
                });
            })


            ->isActive()->latest()->limit(20)->get();
        return response()->json($news);
    }*/

    /*public function getCategorisedNews()
    {
        $locale = app()->getLocale(); // Get the current application locale

        // Get categories with only translations
        $categories = Category::with([
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])->latest()->get();

        // For each category, limit news manually
        foreach ($categories as $category) {
            $category->setRelation(
                'news',
                $category->news()->isActive()->latest()->limit(5)->get()
            );
        }
        // dd($categories->toArray());

        return response()->json($categories);
    }*/

    /*public function getNewsDetails(Request $request, $slug)
    {
        $locale = app()->getLocale(); // Get the current application locale

        // Fetch the news based on the slug and current locale
        $news = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->whereHas('translations', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->isActive()
            ->first();

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        //   dd($news);

        return view('user.news-details', compact('news'));
    }*/

    /*public function getNewsData(Request $request, $slug)
    {
        $locale = app()->getLocale(); // Get the current application locale

        // Fetch the news based on the slug and current locale
        $news = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->whereHas('translations', function ($query) use ($slug, $locale) {
                $query->where('locale', $locale)
                    ->where('slug', $slug);
            })
            ->leftJoin('admins', 'news.created_by', '=', 'admins.id')
            ->select('news.*', 'admins.name as creator_name')
            ->first();
        // dd($news);
        $tags = Tag::whereIn('id', $news->tags ?? [])->get()->toArray();
        $category = Category::with('translations')->find($news->category_id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        // Fetch related news based on the same category
        $relatedNews = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->isActive()
            ->latest()
            ->limit(10)
            ->get();

        // Fetch previous news (latest news before this news in the same category)
        $previousNews = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            // ->where('category_id', $news->category_id)
            ->where('id', '<', $news->id) // ID less than current
            ->isActive()
            ->latest() // Get the latest one before current
            ->first();


        // Fetch next news (earliest news after this news in the same category)
        $nextNews = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            // ->where('category_id', $news->category_id)
            ->where('id', '>', $news->id) // ID greater than current
            ->isActive()
            ->oldest() // Get the oldest one after current
            ->first();

        return response()->json([
            'news' => $news,
            'relatedNews' => $relatedNews,
            'category' => $category,
            'tags' => $tags,
            'previousNews' => $previousNews,
            'nextNews' => $nextNews
        ]);
    }*/

    /*public function getCategoryNews(Request $request, $slug)
    {


        $locale = app()->getLocale();
        $category = Category::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->whereHas('translations', function ($query) use ($slug, $locale) {
                $query->where('locale', $locale)
                    ->where('category_slug', $slug);
            })->first();

        if (!$category) {
            // return response()->json(['message' => 'Category not found'], 404);
            return back()->with('error', "Category Not Found");
        }

        // Fetch news linked to the category, including translations
        $newsList = News::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->whereBetween('created_at', [now()->subDays(20), now()->addDays(1)])
            ->where('category_id', $category->id)
            ->isActive()
            ->latest()
            ->get();
        return view('user.category-news', compact('newsList', 'category'));
        // return response()->json($news);
    }*/

    public function getNews(Request $request)
    {
        $locale = app()->getLocale();
        $city_id = $request->query('city_id', null);
        $state_id = $request->query('state_id', null);
        $q = $request->input('q', null);

        $cacheKey = "news_list_{$locale}_" . md5($q ?? 'all' . "_{$city_id}_{$state_id}");

        $news = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale, $q, $city_id, $state_id) {
            return News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->when($q != null, function ($query) use ($q) {
                    $matchingTagIds = $this->getTagIdsBySearch($q);
                    $query->whereHas('translations', function ($subQuery) use ($q) {
                        $subQuery->where('headline', 'like', "%$q%")
                            ->orWhere('quote', 'like', "%$q%")
                            ->orWhere('details', 'like', "%$q%")
                            ->orWhere('slug', 'like', "%$q%");
                    });
                    $query->orWhere(function ($subQuery) use ($matchingTagIds) {
                        foreach ($matchingTagIds as $tagId) {
                            $subQuery->orWhere('tags', 'like', '%"' . $tagId . '"%');
                        }
                    });
                })
                ->when($city_id != null, function ($query) use ($city_id) {
                    $query->where('city_id', $city_id);
                })
                ->when($state_id != null, function ($query) use ($state_id) {
                    $query->whereIn('city_id', function ($subQuery) use ($state_id) {
                        $subQuery->select('id')->from('cities')->where('state_id', $state_id);
                    });
                })

                ->isActive()
                ->latest()
                ->limit(20)
                ->get();
        });

        return response()->json($news);
    }

    public function liveVideogetNews()
    {
        $locale = app()->getLocale();
        $cacheKey = "live_video_news_{$locale}";

        $news = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale) {
            return News::with('translations')
                ->isActive()
                ->whereNotNull('video_link')
                ->take(10)
                ->get();
        });

        return response()->json($news);
    }

    protected function getTagIdsBySearch($search)
    {
        return Tag::WhereHas('translations', function ($query) use ($search) {
            $query->where('tag_name', 'like', "%$search%");
        })->get()->pluck('id')->toArray();
    }

    public function political_news()
    {
        $locale = app()->getLocale();
        $cacheKey = "political_news_{$locale}";

        $data = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale) {
            $category = Category::whereHas('translations', function ($query) use ($locale) {
                $query->where('locale', 'en')->where('category_slug', 'politics');
            })->first();

            if (!$category) return null;

            $news = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('category_id', $category->id)
                ->isActive()
                ->take(4)
                ->latest()
                ->get();

            return $news;
        });

        if (!$data) {
            return response()->json(['message' => 'Politics category not found'], 404);
        }

        return response()->json($data);
    }

    public function top_news_slider(Request $request)
    {
        $locale = app()->getLocale();
        $q = $request->input('q', null);
        $cacheKey = "top_news_slider_{$locale}_" . md5($q ?? 'all');

        $news = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale, $q) {
            return News::with(['translations', 'creator:id,name,email,phone_number'])   
                ->when($q != null, function ($query) use ($q) {
                    $matchingTagIds = $this->getTagIdsBySearch($q);
                    $query->whereHas('translations', function ($subQuery) use ($q) {
                        $subQuery->where('headline', 'like', "%$q%")
                            ->orWhere('quote', 'like', "%$q%")
                            ->orWhere('details', 'like', "%$q%")
                            ->orWhere('slug', 'like', "%$q%");
                    });
                    $query->orWhere(function ($subQuery) use ($matchingTagIds) {
                        foreach ($matchingTagIds as $tagId) {
                            $subQuery->orWhere('tags', 'like', '%"' . $tagId . '"%');
                        }
                    });
                })
                ->isActive()
                ->latest()
                ->limit(20)
                ->get();
        });

        return response()->json($news);
    }


    protected function clearNewsCaches()
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


  

    public function getCategorisedNews()
    {
        $locale = app()->getLocale();
        $cacheKey = "categorised_news_{$locale}";

        $categories = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale) {
            $categories = Category::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->latest()->get();

            foreach ($categories as $category) {
                $category->setRelation('news', $category->news()->isActive()->latest()->limit(5)->get());
            }

            return $categories;
        });

        return response()->json($categories);
    }

    public function getNewsDetails(Request $request, $slug)
    {
        $locale = app()->getLocale();
        $cacheKey = "news_details_{$locale}_{$slug}";

        $news = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($locale, $slug) {
            return News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->whereHas('translations', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->isActive()
                ->first();
        });

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $ads = Ads::where('status', 1)->get();
        return view('user.news-details', compact('news', 'ads'));
    }

    public function getNewsData(Request $request, $slug)
    {
        $locale = app()->getLocale();
        $cacheKey = "news_data_{$locale}_{$slug}";

        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($locale, $slug) {
            $news = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->whereHas('translations', function ($query) use ($slug, $locale) {
                    $query->where('locale', $locale)->where('slug', $slug);
                })
                ->leftJoin('admins', 'news.created_by', '=', 'admins.id')
                ->select('news.*', 'admins.name as creator_name')
                ->first();

            if (!$news) return null;

            $tags = Tag::whereIn('id', $news->tags ?? [])->get()->toArray();
            $category = Category::with('translations')->find($news->category_id);

            $relatedNews = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('category_id', $news->category_id)
                ->where('id', '!=', $news->id)
                ->isActive()
                ->latest()
                ->limit(10)
                ->get();

            $previousNews = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('id', '<', $news->id)
                ->isActive()
                ->latest()
                ->first();

            $nextNews = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('id', '>', $news->id)
                ->isActive()
                ->oldest()
                ->first();

            return compact('news', 'relatedNews', 'category', 'tags', 'previousNews', 'nextNews');
        });

        if (!$data) {
            return response()->json(['message' => 'News not found'], 404);
        }

        return response()->json($data);
    }

    public function getCategoryNews(Request $request, $slug)
    {
        $locale = app()->getLocale();
        $cacheKey = "category_news_{$locale}_{$slug}";

        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($locale, $slug) {
            $category = Category::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->whereHas('translations', function ($query) use ($slug, $locale) {
                    $query->where('locale', $locale)->where('category_slug', $slug);
                })
                ->first();

            if (!$category) return null;

            $newsList = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->whereBetween('created_at', [now()->subDays(20), now()->addDays(1)])
                ->where('category_id', $category->id)
                ->isActive()
                ->latest()
                ->get();

            return compact('category', 'newsList');
        });

        if (!$data) {
            return back()->with('error', "Category Not Found");
        }

        return view('user.category-news', $data);
    }

    // line 441

}


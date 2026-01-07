<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class NewsControllerCopy extends Controller
{

    public function r_getNews(Request $request)
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
            ->get();

        return response()->json($news);
    }
    public function getNews(Request $request)
    {
        $locale = app()->getLocale();
        $city_id = Session::has('city') ? optional(Session::get('city'))->id : null;
        $q = $request->input('q', null);

        // Generate a unique cache key
        $cacheKey = 'news_' . $locale . '_' . ($city_id ?? 'all') . '_' . md5($q ?? 'no_query');

        // Store and retrieve from cache for 10 minutes
        $news = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale, $q, $city_id) {
            return News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->when($q != null, function ($query) use ($q) {
                    $matchingTagIds = $this->getTagIdsBySearch($q);
                    $query->where(function ($subQuery) use ($q, $matchingTagIds) {
                        $subQuery->whereHas('translations', function ($subQ) use ($q) {
                            $subQ->where('headline', 'like', "%$q%")
                                ->orWhere('quote', 'like', "%$q%")
                                ->orWhere('details', 'like', "%$q%")
                                ->orWhere('slug', 'like', "%$q%");
                        });

                        foreach ($matchingTagIds as $tagId) {
                            $subQuery->orWhere('tags', 'like', '%"' . $tagId . '"%');
                        }
                    });
                })
                ->when($city_id != null, function ($query) use ($city_id) {
                    $query->where('city_id', $city_id);
                })
                ->isActive()
                ->latest()
                ->get();
        });

        return response()->json($news);
    }



    public function r_liveVideogetNews()
    {
        $news = News::with('translations')->isActive()->whereNotNull('video_link')->take(10)->get();
        return response()->json($news);
    }
    public function liveVideogetNews()
    {
        $locale = app()->getLocale(); // For localized results if needed
        $cacheKey = 'live_video_news_' . $locale;

        // Cache for 5 minutes (adjust if needed)
        $news = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($locale) {
            return News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->isActive()
                ->whereNotNull('video_link')
                ->take(10)
                ->get();
        });

        return response()->json($news);
    }

    protected function r_getTagIdsBySearch($search)
    {
        $tags = Tag::WhereHas('translations', function ($query) use ($search) {
            $query->where('tag_name', 'like', "%$search%");
        })->get()->pluck('id')->toArray();
        return $tags;
    }
    protected function getTagIdsBySearch($search)
    {
        // Normalize search key for caching
        $searchKey = strtolower(trim($search));
        $cacheKey = "tag_ids_by_search_" . md5($searchKey);

        // Cache for 30 minutes
        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($searchKey) {
            return Tag::whereHas('translations', function ($query) use ($searchKey) {
                $query->where('tag_name', 'like', "%{$searchKey}%");
            })
                ->pluck('id')
                ->toArray();
        });
    }

    public function r_political_news()
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
            ->get();

        return response()->json($news);
    }
    public function political_news()
    {
        $locale = app()->getLocale();

        // Cache the politics category ID per locale
        $categoryCacheKey = "category_politics_id_{$locale}";
        $politicsCategoryId = Cache::remember($categoryCacheKey, now()->addHours(1), function () use ($locale) {
            $category = Category::whereHas('translations', function ($query) use ($locale) {
                $query->where('locale', $locale)
                    ->where('category_slug', 'politics');
            })->first();

            return $category?->id;
        });

        if (!$politicsCategoryId) {
            return response()->json(['message' => 'Politics category not found'], 404);
        }

        // Cache the news list per locale for politics category
        $newsCacheKey = "politics_news_{$locale}";

        $news = Cache::remember($newsCacheKey, now()->addMinutes(10), function () use ($locale, $politicsCategoryId) {
            return News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('category_id', $politicsCategoryId)
                ->isActive()
                ->get();
        });

        return response()->json($news);
    }

    public function r_top_news_slider(Request $request)
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


            ->isActive()->get();
        return response()->json($news);
    }
    public function top_news_slider(Request $request)
    {
        $locale = app()->getLocale(); // Useful if translations depend on it
        $q = $request->input('q', null);

        // Use different cache keys for queries and no-query cases
        $cacheKey = $q
            ? 'top_news_slider_search_' . md5($q . '_' . $locale)
            : 'top_news_slider_default_' . $locale;

        // Cache result for 10 minutes
        $news = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($q, $locale) {
            return News::with([
                'translations' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                },
                'creator:id,name,email,phone_number'
            ])
                ->when($q != null, function ($query) use ($q) {
                    $matchingTagIds = $this->getTagIdsBySearch($q);

                    $query->where(function ($query) use ($q, $matchingTagIds) {
                        $query->whereHas('translations', function ($subQuery) use ($q) {
                            $subQuery->where('headline', 'like', "%$q%")
                                ->orWhere('quote', 'like', "%$q%")
                                ->orWhere('details', 'like', "%$q%")
                                ->orWhere('slug', 'like', "%$q%");
                        });

                        if (!empty($matchingTagIds)) {
                            $query->orWhere(function ($subQuery) use ($matchingTagIds) {
                                foreach ($matchingTagIds as $tagId) {
                                    $subQuery->orWhere('tags', 'like', '%"' . $tagId . '"%');
                                }
                            });
                        }
                    });
                })
                ->isActive()
                ->get();
        });

        return response()->json($news);
    }

    public function r_getCategorisedNews()
    {
        $locale = app()->getLocale(); // Get the current application locale

        $categories = Category::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }, 'news' => function ($query) {
            $query->isActive();
        }])->get();

        return response()->json($categories);
    }

    public function getCategorisedNews()
    {
        $locale = app()->getLocale();
        $cacheKey = "categorised_news_{$locale}";

        // Cache the data for 30 minutes
        $categories = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($locale) {
            return Category::with([
                'translations' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                },
                'news' => function ($query) use ($locale) {
                    $query->isActive()
                        ->with(['translations' => function ($subQuery) use ($locale) {
                            $subQuery->where('locale', $locale);
                        }]);
                }
            ])->get();
        });

        return response()->json($categories);
    }

    public function r_getNewsDetails(Request $request, $slug)
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
    }

    public function getNewsDetails(Request $request, $slug)
    {
        $locale = app()->getLocale();

        $cacheKey = "news_details_{$locale}_{$slug}";

        $news = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($slug, $locale) {
            return News::with([
                'translations' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])
                ->whereHas('translations', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->isActive()
                ->first();
        });

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        return view('user.news-details', compact('news'));
    }

    public function r_getNewsData(Request $request, $slug)
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
            ->first();
        $tags = Tag::whereIn('id', $news->tags)->get()->toArray();
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
    }
    public function getNewsData(Request $request, $slug)
    {
        $locale = app()->getLocale();
        $cacheKey = "news_data_{$locale}_{$slug}";

        // Try to retrieve from cache or store it if missing
        $cachedResponse = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($slug, $locale) {
            $news = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->whereHas('translations', function ($query) use ($slug, $locale) {
                    $query->where('locale', $locale)
                        ->where('slug', $slug);
                })
                ->first();

            if (!$news) {
                return null;
            }

            $tags = Tag::whereIn('id', $news->tags ?? [])->get()->toArray();
            $category = Category::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->find($news->category_id);

            $relatedNews = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('category_id', $news->category_id)
                ->where('id', '!=', $news->id)
                ->isActive()
                ->latest()
                ->take(5)
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

            return [
                'news' => $news,
                'relatedNews' => $relatedNews,
                'category' => $category,
                'tags' => $tags,
                'previousNews' => $previousNews,
                'nextNews' => $nextNews
            ];
        });

        if (!$cachedResponse) {
            return response()->json(['message' => 'News not found'], 404);
        }

        return response()->json($cachedResponse);
    }

    public function r_getCategoryNews(Request $request, $slug)
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
            ->where('category_id', $category->id)
            ->isActive()
            ->get();
        return view('user.category-news', compact('newsList', 'category'));
        // return response()->json($news);
    }

    public function getCategoryNews(Request $request, $slug)
    {
        $locale = app()->getLocale();
        $cacheKey = "category_news_{$locale}_{$slug}";

        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($slug, $locale) {
            // Get category by slug + locale
            $category = Category::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->whereHas('translations', function ($query) use ($slug, $locale) {
                    $query->where('locale', $locale)
                        ->where('category_slug', $slug);
                })
                ->first();

            if (!$category) {
                return null;
            }

            // Get all news for this category
            $newsList = News::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
                ->where('category_id', $category->id)
                ->isActive()
                ->get();

            return compact('category', 'newsList');
        });

        if (!$data) {
            return back()->with('error', "Category Not Found");
        }

        return view('user.category-news', $data);
    }
}

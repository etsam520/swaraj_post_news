@extends('user.layouts.main')
@php($ad = \App\Models\Ads::orderBy('status', 'asc')->orderBy('created_at', 'desc')->first())
@push('meta-data')
    <meta name="news-slug" content="{{ $news->slug }}">
    <meta name="news_id" content="{{ $news->id }}">
    <meta name="user_id" content="{{ Auth::check() ? Auth::user()->id : null }}">

    @section('meta_title', $news->headline)
@section('meta_description', Str::limit(strip_tags($news->deails ?? $news->quote), 160))
@section('meta_canonical', request()->fullUrl())
@section('meta_image', $news->image ? Storage::disk('s3')->url($news->image) :
    asset('assets/images/brand/swaraj-banner.jpg'))
    @push('meta-data')
        {{-- You can include any additional structured data here if needed --}}
    @endpush



@endpush
@section('containt')
    <div id="wrapper" class="wrap overflow-hidden-x">
        <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><a href="blog-category.html">Strategy</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">The Rise of Gourmet Street Food: Trends and Top Picks</span></li>
                </ul>
            </div>
        </div>

        <article class="post type-post single-post py-4 lg:py-6 xl:py-9">
            <div class="container max-w-xl">

            </div>
            <div class="panel">
                <div class="container max-w-lg">
                    <div class="row">
                        <div class="col-lg-8" id="newsDetailsContainer">
                            <div class="panel vstack sm:hstack gap-3 justify-between s py-1 mt-2 xl:py-2 xl:mt-1">
                                <ul class="nav-x gap-narrow text-primary" id="post-tags">
                                    <li><span class="text-black dark:text-white me-narrow">Tags:</span></li>

                                </ul>
                                <ul class="post-share-icons nav-x gap-narrow">
                                    <li class="me-1"><span class="text-black dark:text-white">Share:</span></li>
                                    <!--li>
                                        <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                            href="javascript:void(0)"><i class="unicon-logo-facebook icon-1"></i></a>
                                    </!li>
                                    <li>
                                        <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                            href="javascript:void(0)"><i class="unicon-logo-x-filled icon-1"></i></a>
                                    </li>
                                    <li>
                                        <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                            href="javascript:void(0)"><i class="unicon-email icon-1"></i></a>
                                    </li -->
                                    <li>
                                        <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                            href="javascript:void(0)" id="shareButton"><i
                                                class="unicon-link icon-1"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="post-header">
                                <div class="panel">
                                    <figure class="featured-image m-0 main-figure">
                                        <figure
                                            class="featured-image m-0 ratio ratio-2x1 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                src="" data-src=""
                                                alt="The Rise of Gourmet Street Food: Trends and Top Picks"
                                                data-uc-img="loading: lazy">
                                        </figure>
                                    </figure>
                                    <div class="panel vstack max-w-400px sm:max-w-500px xl:max-w-md mx-auto gap-2 md:gap-3">
                                        <h1 class="mt-3 mb-2 headline">The Rise of Gourmet Street Food: Trends and
                                            Top
                                            Picks</h1>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex items-center border-bottom mb-2 gap-2 md:flex-row lg:p-0 lg:py-2 author-area">
                                <div class="rounded-full"><img alt="author img" title="Swaraj Bihar Team" loading="lazy"
                                        width="50" height="50" decoding="async" data-nimg="1" class="rounded-full"
                                        style="color:transparent" src="javascript:void(0)" pinger-seen="true"></div>
                                <div class="block sm:block items-center gap-4">
                                    <p class="text-[0.85rem] sm:text-[0.85rem]">By<!-- --> <span
                                            class="font-medium dark:text-white"> <a href="javascript:void(0)"
                                                class="hover:text-primary author-name">Swaraj</a></span></p>
                                    <div class="sm:flex gap-2 sm:items-center block published-date">
                                        <p class="text-[0.75rem] sm:text-[0.75rem]"> <!-- -->Published :<!-- -->
                                            <!-- -->April 18, 2025 at 6:46
                                            PM IST<!-- --> </p><span class="hidden text-[0.75rem] md:inline-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-content panel fs-6 md:fs-5" data-uc-lightbox="animation: scale">

                            </div>

                            <div class="row gx-1" id="news-video-container">
                                <div class="col-12 post-media-wrap">
                                    <iframe src="" height="400px" class="w-100" title="" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" id="categorized-container">
                            <div class="block-content">
                                <div class="panel">
                                    @if (isset($ad))
                                        <a href="{{ $ad->link }}" target="_blank">
                                            <img src="{{ Helpers::getCloudImageUrl($ad->cover_image) }}"
                                                alt="{{ $ad->title }}" class="img-fluid rounded">
                                        </a>
                                        <p class="mt-1 text-dark text-sm">{{ Str::limit($ad->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="panel cstack gap-2 h-100">
                                <div class="widget ad-widget vstack gap-2">
                                    <div class="block-layout grid-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                        <div class="block-header panel pt-1">
                                            <h2
                                                class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                                <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150 text-danger mt-2 pb-2 border-bottom"
                                                    href="javascript:void(0)">
                                                    <h4 class="fw-bolder mb-0 category-title">Poltics
                                                        <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                                    </h4>
                                                </a>
                                            </h2>
                                        </div>
                                        <div class="block-content">
                                            <div class="panel row child-cols-12 md:child-cols g-2 lg:g-4 col-match sep-y"
                                                data-uc-grid>
                                                <div class="order-1 md:order-0">
                                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x articles-container">
                                                        <div>
                                                            <article class="post type-post panel uc-transition-toggle">
                                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                                    <div>
                                                                        <div
                                                                            class="post-header panel vstack justify-between gap-1">
                                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                                <a class="text-none hover:text-primary duration-150"
                                                                                    href="blog-details.html">The
                                                                                    Future of
                                                                                    Sustainable Living: Driving
                                                                                    Eco-Friendly
                                                                                    Lifestyles</a>
                                                                            </h3>
                                                                            <div
                                                                                class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                                <span>12h</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                            <div
                                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                                                    src="#" data-src="#"
                                                                                    alt="The Future of Sustainable Living: Driving Eco-Friendly Lifestyles"
                                                                                    data-uc-img="loading: lazy">
                                                                            </div>
                                                                            <a href="blog-details.html"
                                                                                class="position-cover"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- prev or next -->
                    <div class="post-navigation panel vstack sm:hstack justify-between gap-2 mt-8 xl:mt-9"
                        id="post-navigation">
                        <div class="new-post panel hstack w-100 sm:w-1/2 prev-container">
                            <div class="panel vstack justify-center px-2 gap-1 w-1/3">
                                <span class="fs-7 opacity-60">Prev Article</span>
                                <h6 class="h6 lg:h5 m-0">Tech Innovations Reshaping the Retail Landscape: AI Payments
                                </h6>
                            </div>
                            <a href="blog-details.html" class="position-cover"></a>
                        </div>
                        <div class="new-post panel hstack w-100 sm:w-1/2 next-container">
                            <div class="panel vstack justify-center px-2 gap-1 w-1/3 text-end">
                                <span class="fs-7 opacity-60">Next Article</span>
                                <h6 class="h6 lg:h5 m-0">The Rise of AI-Powered Personal Assistants: How They Manage
                                </h6>
                            </div>
                            <a href="blog-details.html" class="position-cover"></a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="panel">
                            @if (isset($ad))
                                <a href="{{ $ad->link }}" target="_blank">
                                    <img src="{{ Helpers::getCloudImageUrl($ad->cover_image) }}" alt="{{ $ad->title }}"
                                        class="img-fluid rounded">
                                </a>
                                <p class="mt-1 text-dark text-sm">{{ Str::limit($ad->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                    <!-- prev or next end -->

                    <!-- related to this topic -->
                    <!--div class="post-related panel border-top pt-2 mt-8 xl:mt-9">
                        <h4 class="h5 xl:h4 mb-5 xl:mb-6">Related to this topic:</h4>
                        <div class="row child-cols-6 md:child-cols-3 gx-2 gy-4 sm:gx-3 sm:gy-6">
                            <div>
                                <article class="post type-post panel vstack gap-2">
                                    <figure
                                        class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                            src="#"
                                            data-src="{{ asset('user/images/demo-seven/posts/img-08.jpg') }}"
                                            alt="The Art of Baking: From Classic Bread to Artisan Pastries"
                                            data-uc-img="loading: lazy">
                                        <a href="blog-details.html" class="position-cover"
                                            data-caption="The Art of Baking: From Classic Bread to Artisan Pastries"></a>
                                    </figure>
                                    <div class="post-header panel vstack gap-1">
                                        <h5 class="h6 md:h5 m-0">
                                            <a class="text-none" href="blog-details.html">The Art of Baking: From
                                                Classic Bread to Artisan Pastries</a>
                                        </h5>
                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                            <span>Feb 28, 2024</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div>
                                <article class="post type-post panel vstack gap-2">
                                    <figure
                                        class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                            src="#"
                                            data-src="{{ asset('user/images/demo-seven/posts/img-09.jpg') }}"
                                            alt="AI and Marketing: Unlocking Customer Insights" data-uc-img="loading: lazy">
                                        <a href="blog-details.html" class="position-cover"
                                            data-caption="AI and Marketing: Unlocking Customer Insights"></a>
                                    </figure>
                                    <div class="post-header panel vstack gap-1">
                                        <h5 class="h6 md:h5 m-0">
                                            <a class="text-none" href="blog-details.html">AI and Marketing: Unlocking
                                                Customer Insights</a>
                                        </h5>
                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                            <span>Feb 22, 2024</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div>
                                <article class="post type-post panel vstack gap-2">
                                    <figure
                                        class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                            src="#"
                                            data-src="{{ asset('user/images/demo-seven/posts/img-09.jpg') }}"
                                            alt="Hidden Gems: Underrated Travel Destinations Around the World"
                                            data-uc-img="loading: lazy">
                                        <a href="blog-details.html" class="position-cover"
                                            data-caption="Hidden Gems: Underrated Travel Destinations Around the World"></a>
                                    </figure>
                                    <div class="post-header panel vstack gap-1">
                                        <h5 class="h6 md:h5 m-0">
                                            <a class="text-none" href="blog-details.html">Hidden Gems: Underrated Travel
                                                Destinations Around the World</a>
                                        </h5>
                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                            <span>Feb 14, 2024</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div>
                                <article class="post type-post panel vstack gap-2">
                                    <figure
                                        class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                            src="#"
                                            data-src="#"
                                            alt="Eco-Tourism: Traveling Responsibly and Sustainably"
                                            data-uc-img="loading: lazy">
                                        <a href="blog-details.html" class="position-cover"
                                            data-caption="Eco-Tourism: Traveling Responsibly and Sustainably"></a>
                                    </figure>
                                    <div class="post-header panel vstack gap-1">
                                        <h5 class="h6 md:h5 m-0">
                                            <a class="text-none" href="blog-details.html">Eco-Tourism: Traveling
                                                Responsibly and Sustainably</a>
                                        </h5>
                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                            <span>Feb 8, 2024</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </!div-->

                    <!-- related to this topic ends -->

                    <!-- comment section -->
                    <div id="blog-comment" class="panel border-top pt-2 mt-8 xl:mt-9">
                        <h4 class="h5 xl:h4 mb-5 xl:mb-6 show-comment-count">Comments (5)</h4>

                        <div class="spacer-half"></div>

                        <ol>
                            <li>
                                <div class="avatar">
                                    <img src="#" alt="">
                                </div>
                                <div class="comment-info">
                                    <span class="c_name">Merrill Rayos</span>
                                    <span class="c_date id-color">2 days ago</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="comment"></div>
                                <ol>
                                    <li>
                                        <div class="avatar">
                                            <img src="#" alt="">
                                        </div>
                                        <div class="comment-info">
                                            <span class="c_name">Jackqueline Sprang</span>
                                            <span class="c_date id-color">2 days ago</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">#</div>
                                    </li>
                                </ol>
                            </li>
                        </ol>

                        <div class="spacer-single"></div>

                        <div id="comment-form-wrapper" class="panel pt-2 mt-8 xl:mt-9">
                            <h4 class="h5 xl:h4 mb-5 xl:mb-6">Leave a Comment</h4>
                            <div class="comment_form_holder">
                                <form class="vstack gap-2" id="leaveCommentForm">
                                    <textarea name="comment"
                                        class="form-control h-250px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                        type="text" placeholder="Your comment" required></textarea>
                                    <button class="btn btn-primary btn-sm mt-1" type="submit">Send</button>
                                </form>
                                <div id="messageBoxComment" class="alert d-none"></div>
                            </div>
                        </div>
                    </div>
                    <!-- commen section ends -->
                </div>
            </div>
        </article>

        <!-- Newsletter -->
    </div>






    <div class="container-fluid bg-light">
        <div class="container">
            <nav aria-label="breadcrumb" style="padding: 14px 0;">
                <ol class="breadcrumb" style="background: none; padding: 0; margin: 0; font-size: 1.1rem;">
                    <li class="breadcrumb-item"><a href="" class="text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="" class="text-muted">News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($news->headline) }}</li>
                </ol>
            </nav>
        </div>
    </div>
    

   <div class="news-detail-main" id="news-detail-main">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 px-lg-3 px-0">
               <div class="news-detail-container">
                  <div class="news-detail-share">
                     <span>Share:</span>
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-x-twitter"></i></a>
                     <a href="#"><i class="fab fa-whatsapp"></i></a>
                  </div>
                  <img src="assets/img/news/news-detail.jpg" alt="News Image"
                     class="news-detail-image">
                  <div class="news-detail-title" id="news-detail-title">
                     Dummy News Headline: Major Event Shakes the City                        
                  </div>
                  <div class="news-detail-meta">
                     By <a href="#">John Doe</a>
                     <span>Published :
                     June 01, 2024 at 10:30 AM                                IST</span>
                  </div>
                  <div class="news-detail-content">
                     <p><span class="dropcap">L</span>orem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisl quis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                     <p>Aliquam erat volutpat. Etiam ac mauris lectus. Mauris euismod, sapien nec commodo gravida, enim erat dictum urna, nec dictum velit enim at erat. Suspendisse potenti.</p>
                  </div>
                  <div class="news-detail-nav d-lg-flex justify-content-between mt-4 align-items-center"
                     style="gap: 10px;">
                     <div class="news-prev">
                        <a href="#"
                           class="d-flex align-items-center text-decoration-none" style="color:#888;">
                           <img src="assets/img/news/news-prev.jpg"
                              alt=""
                              style="width:48px;height:38px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-right:10px;">
                           <div>
                              <div style="font-size:0.9rem;color:#bbb;"><i
                                 class="fa fa-arrow-left mr-2"></i>Prev Article</div>
                              <div
                                 style="font-weight:600;color:#222;line-height:1.2;font-size:1.05rem;white-space:normal;">
                                 Tech Innovations Reshaping the Retail Landscape: AI Payments                                            
                              </div>
                           </div>
                        </a>
                     </div>
                     <div class="news-next">
                        <a href="#"
                           class="d-flex align-items-center justify-content-end text-decoration-none"
                           style="color:#888;">
                           <div>
                              <div style="font-size:0.9rem;color:#bbb;text-align:right;">Next Article<i
                                 class="fa fa-arrow-right ml-2"></i></div>
                              <div
                                 style="font-weight:600;color:#222;line-height:1.2;font-size:1.05rem;white-space:normal;text-align:right;">
                                 The Rise of AI-Powered Personal Assistants: How They Manage
                              </div>
                           </div>
                           <img src="assets/img/news/news-next.jpg"
                              alt=""
                              style="width:48px;height:38px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-left:10px;">
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block px-lg-3 px-0">
               <div class="news-list-sidebar"
                  style="background:#fff;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.04);padding:20px 16px;">
                  <h5 style="font-weight:700;margin-bottom:18px;">Latest News</h5>
                  <ul class="list-unstyled" style="margin:0;padding:0;">
                     <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <img src="assets/img/news/news1.jpg" alt=""
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;">
                        <div>
                           <a href="#"
                              style="font-weight:600;color:#222;text-decoration:none;">
                           Dummy News Title 1                                        </a>
                           <div style="font-size:0.95rem;color:#888;">
                              Jan 01, 2024                                        
                           </div>
                        </div>
                     </li>
                     <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <img src="assets/img/news/news2.jpg" alt=""
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;">
                        <div>
                           <a href="#"
                              style="font-weight:600;color:#222;text-decoration:none;">
                           Dummy News Title 2                                        </a>
                           <div style="font-size:0.95rem;color:#888;">
                              Feb 15, 2024                                        
                           </div>
                        </div>
                     </li>
                     <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <img src="assets/img/news/news3.jpg" alt=""
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;">
                        <div>
                           <a href="#"
                              style="font-weight:600;color:#222;text-decoration:none;">
                           Dummy News Title 3                                        </a>
                           <div style="font-size:0.95rem;color:#888;">
                              Mar 10, 2024                                        
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('js')
    <script src="{{ asset('user/js/news-details.js') }}"></script>
@endpush

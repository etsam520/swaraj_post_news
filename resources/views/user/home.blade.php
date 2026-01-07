@extends('user.layouts.main')
@section('meta_title', 'Swaraj Post – Latest News, Breaking Updates, and Insights')
@section('meta_description', 'Stay updated with top headlines and in-depth news stories from across India, only on Swaraj Post.')
@section('meta_canonical', url('/'))
{{-- @section('meta_image', asset('assets/images/brand/swaraj-post-logo.png')) replace with real image --}}
@section('meta_image', asset('assets/images/brand/swaraj-banner.jpg'))

@section('containt') 
    <section class="news-slider-section skeleton-loading" style="margin: 40px 0;" id="top-news-wrapper">
        <div class="container-fluid">
            <div class="swiper news-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="news-card skeleton">
                            <div class="skeleton-img" style="width: 50px;height: 50px;margin-right: 20px;"></div>
                            <div class="text">
                                <div class="title skeleton-text" style="width: 80%"></div>
                                <div class="desc skeleton-text" style="width: 100%"></div>
                                <div class="desc skeleton-text" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="news-card skeleton">
                            <div class="skeleton-img" style="width: 50px;height: 50px;margin-right: 20px;"></div>
                            <div class="text">
                                <div class="title skeleton-text" style="width: 80%"></div>
                                <div class="desc skeleton-text" style="width: 100%"></div>
                                <div class="desc skeleton-text" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="news-card skeleton">
                            <div class="skeleton-img" style="width: 50px;height: 50px;margin-right: 20px;"></div>
                            <div class="text">
                                <div class="title skeleton-text" style="width: 80%"></div>
                                <div class="desc skeleton-text" style="width: 100%"></div>
                                <div class="desc skeleton-text" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="news-card skeleton">
                            <div class="skeleton-img" style="width: 50px;height: 50px;margin-right: 20px;"></div>
                            <div class="text">
                                <div class="title skeleton-text" style="width: 80%"></div>
                                <div class="desc skeleton-text" style="width: 100%"></div>
                                <div class="desc skeleton-text" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="news-card skeleton">
                            <div class="skeleton-img" style="width: 50px;height: 50px;margin-right: 20px;"></div>
                            <div class="text">
                                <div class="title skeleton-text" style="width: 80%"></div>
                                <div class="desc skeleton-text" style="width: 100%"></div>
                                <div class="desc skeleton-text" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="news-card skeleton">
                            <div class="skeleton-img" style="width: 50px;height: 50px;margin-right: 20px;"></div>
                            <div class="text">
                                <div class="title skeleton-text" style="width: 80%"></div>
                                <div class="desc skeleton-text" style="width: 100%"></div>
                                <div class="desc skeleton-text" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="swiper-slide">
                        <div class="news-card">
                            <img src="assets/img/news/news2.jpg" alt="news">
                            <div class="text">
                                <div class="title">पूर्णिया में एक ही परिवार के 4...</div>
                                <div class="desc">पूर्णिया में एक ही परिवार के 4 लोगों की हत्या, भीड़ ने पीट-पीटकर मार
                                    डाला</div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
            </div>
        </div>
    </section>

    <section class="featured-news-section my-4" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-8 px-lg-3 px-0" id="featured-news-container">
                    <div class="swiper featured-news-swiper rounded-2 overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="featured-news-card position-relative skeleton">
                                    <div class="skeleton-img" style="height: 500px;"></div>
                                    <div class="featured-news-overlay">
                                        <div class="title skeleton-text" style="width: 30%"></div>
                                        <div class="featured-news-title skeleton-text" style="width: 93%; height: 40px"></div>
                                        <div class="featured-news-meta">
                                            <div class="title skeleton-text" style="width: 18%"></div>
                                        </div>
                                        <div class="title skeleton-text mt-1" style="width: 5%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="featured-news-card position-relative skeleton">
                                    <div class="skeleton-img" style="height: 500px;"></div>
                                    <div class="featured-news-overlay">
                                        <div class="title skeleton-text" style="width: 30%"></div>
                                        <div class="featured-news-title skeleton-text" style="width: 93%; height: 40px"></div>
                                        <div class="featured-news-meta">
                                            <div class="title skeleton-text" style="width: 18%"></div>
                                        </div>
                                        <div class="title skeleton-text mt-1" style="width: 5%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="featured-news-card position-relative skeleton">
                                    <div class="skeleton-img" style="height: 500px;"></div>
                                    <div class="featured-news-overlay">
                                        <div class="title skeleton-text" style="width: 30%"></div>
                                        <div class="featured-news-title skeleton-text" style="width: 93%; height: 40px"></div>
                                        <div class="featured-news-meta">
                                            <div class="title skeleton-text" style="width: 18%"></div>
                                        </div>
                                        <div class="title skeleton-text mt-1" style="width: 5%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="featured-news-card position-relative skeleton">
                                    <div class="skeleton-img" style="height: 500px;"></div>
                                    <div class="featured-news-overlay">
                                        <div class="title skeleton-text" style="width: 30%"></div>
                                        <div class="featured-news-title skeleton-text" style="width: 93%; height: 40px"></div>
                                        <div class="featured-news-meta">
                                            <div class="title skeleton-text" style="width: 18%"></div>
                                        </div>
                                        <div class="title skeleton-text mt-1" style="width: 5%"></div>
                                    </div>
                                </div>
                            </div>
                           
                            <!-- <div class="swiper-slide">
                                <div class="featured-news-card position-relative">
                                    <img src="https://givni.sgp1.digitaloceanspaces.com/swaraj_uploads/news/thumbnails/686bae9ad23c1.jpg"
                                        alt="featured news" class="featured-news-img">
                                    <div class="featured-news-overlay">
                                        <div class="featured-news-time">3 hours ago</div>
                                        <div class="featured-news-title">
                                            कोरोना खत्म, लेकिन अकेलापन बना नई महामारी, WHO की चेतावनी से बढ़ी दुनियाभर में चिंता..!
                                        </div>
                                        <div class="featured-news-meta">
                                            <span class="fw-semibold">Admin</span>
                                            <span><i class="far fa-comment-alt"></i> 11</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!-- <div class="swiper-button-next featured-swiper-btn"></div>
                        <div class="swiper-button-prev featured-swiper-btn"></div> -->
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 px-lg-3 px-0" id="political-container">
                    <div class="featured-news-sidebar">
                        <div class="featured-news-sidebar-title">
                            Politics <i class="fas fa-chevron-right sidebar-chevron"></i>
                        </div>
                        <hr class="featured-news-sidebar-hr">
                        
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        <div class="featured-news-sidebar-item">
                            <div class="featured-news-sidebar-item-title skeleton-text" style="width: 100%; height: 40px"></div>  
                        </div>
                        
                        <!-- <div class="featured-news-sidebar-item">
                            <img src="https://via.placeholder.com/60x60?text=News" alt="news" class="featured-news-sidebar-img">
                            <div>
                                <div class="featured-news-sidebar-item-title">लोकसभा चुनाव 2024: भाजपा की बड़ी जीत</div>
                                <div class="featured-news-sidebar-item-time">1 hour ago</div>
                            </div>
                        </div> -->
                    </div>

                    
                </div>
            </div>
        </div>
    </section>


    <section class="latest-videos-section d-none" id="latest-videos-section" style="background: #181818; padding: 32px 0;">
        <div class="container-fluid">
            <div class="row align-items-start">
                <div class="col-lg-4 col-md-5 mb-4">
                    <div
                        style="color:#fff; font-weight:700; font-size:1.2rem; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
                        <span style="color:#e74c3c; font-size:1.5rem;">•</span> LATEST VIDEOS
                    </div>
                    <div class="video-list"
                        style="background:#444; border-radius:12px; padding:16px 0 0 0; margin-bottom:16px;">
                        <div class="video-list-item active"
                            style="display:flex; align-items:center; gap:14px; padding:10px 18px; border-radius:10px 10px 0 0; background:#333;">
                            <img src="https://img.youtube.com/vi/VIDEO_ID_1/mqdefault.jpg" alt="thumb"
                                style="width:56px; height:56px; border-radius:8px; object-fit:cover;">
                            <div style="color:#fff; font-size:1rem; font-weight:500; line-height:1.3;">
                                MP Sudhakar Singh made serious allegations against the Rural Works...
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="video-prev-btn"
                            style="background:#e74c3c; color:#fff; border:none; border-radius:10px; font-weight:700; padding:8px 20px; margin-bottom:6px;">Prev</button>
                        <button class="video-next-btn"
                            style="background:#e74c3c; color:#fff; border:none; border-radius:10px; font-weight:700; padding:8px 20px;">Next</button>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="video-player" style="border-radius:16px; overflow:hidden; background:#111;">
                        <iframe id="main-video-iframe" width="100%" height="420"
                            src="https://www.youtube.com/embed/VIDEO_ID_1" frameborder="0" allowfullscreen
                            style="border-radius:16px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="visual-stories-section d-none" style="padding:80px 0;" id="visual-stories-section">
        <div class="container-fluid">
            <div
                style="font-size:1.5rem; font-weight:700; color:#e74c3c; margin-bottom:8px; display:flex; align-items:center; gap:8px;">
                <span style="color:#e74c3c; font-size:1.5rem;">&#9679;</span>
                <span style="color:#222;">विजुअल स्टोरीज़</span>
            </div>
            <hr style="margin:0 0 24px 0; border-top:1px solid #eee;">
            <div class="swiper visual-stories-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story1.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                जब पिताजी ने पकड़ा झूठ... बिंटू का हुआ बुरा हाल, आप भी प...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story2.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                बिहार की इस बैंक में निकली सरकारी नौकरी, ये है अप्लाई...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story3.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                घर की इन 5 जगहों में बैठकर कभी न खाएं खाना, हो जाएगा ब...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story4.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                ना बर्थडे विश, ना 'धुरंधर' के टीजर पर रिएक्शन, रणवीर औ...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story5.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                जानिए आपके शहर का मौसम कैसा है?
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story6.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                49 चौके और 367* रन... इस क्रिकेटर ने काटा गदर, टूटते-टूट...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story6.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                49 चौके और 367* रन... इस क्रिकेटर ने काटा गदर, टूटते-टूट...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story6.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                49 चौके और 367* रन... इस क्रिकेटर ने काटा गदर, टूटते-टूट...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story6.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                49 चौके और 367* रन... इस क्रिकेटर ने काटा गदर, टूटते-टूट...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                            <img src="assets/img/stories/story6.jpg" alt="story"
                                style="width:100%; height:160px; object-fit:cover;">
                            <div
                                style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                49 चौके और 367* रन... इस क्रिकेटर ने काटा गदर, टूटते-टूट...
                            </div>
                            <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>

    <section class="category-section bg-light" id="category-section-news" style="padding: 40px 0;">
        <div class="container-fluid">
            <div style="font-size:1.4rem; font-weight:700; color:#222; display:flex; align-items:center; gap:8px;">
                <span style="color:#e74c3c; font-size:1.3rem;">&#9679;</span>
                <span class="title skeleton-text" style="width:40%;height:50px"></span>
                <a href="#"
                    style="margin-left:auto; color:#e74c3c; font-weight:700; font-size:1rem; text-decoration:none;">और
                    भी <span style="font-size:1.1rem;">&#8250;</span></a>
            </div>
            <div class="row" style="margin-top:16px;">
                <div class="col-lg-8 col-md-7 mb-3">
                    <div style="background:#fff; border-radius:8px; overflow:hidden;">
                          <div class="skeleton-img" style="width: 100%;height: 350px;"></div>
                        <div class="desc skeleton-text" style="width: 100% ;height:35px"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">
                            <div class="skeleton-img" style="width:75px;height: 75px;"></div>
                             <div class="desc skeleton-text" style="width: 100% ;height:45px"></div>
                        </div>
                        <hr style="margin:0 0 18px 0; border-top:1px solid #eee;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">
                            <div class="skeleton-img" style="width:75px;height: 75px;"></div>
                             <div class="desc skeleton-text" style="width: 100% ;height:45px"></div>
                        </div>
                        <hr style="margin:0 0 18px 0; border-top:1px solid #eee;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">
                            <div class="skeleton-img" style="width:75px;height: 75px;"></div>
                             <div class="desc skeleton-text" style="width: 100% ;height:45px"></div>
                        </div>
                        <hr style="margin:0 0 18px 0; border-top:1px solid #eee;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">
                            <div class="skeleton-img" style="width:75px;height: 75px;"></div>
                             <div class="desc skeleton-text" style="width: 100% ;height:45px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')
<script src="{{asset('user/js/home.js')}}?v=2"></script>
<script>
//     document.addEventListener("keydown", function (event) {
//     if ((event.key === "F5") || (event.ctrlKey && event.key === "r")) {
//         event.preventDefault();

//         // Your custom actions before refresh
//         localStorage.clear();
//         sessionStorage.clear();

//         alert("Page will refresh in 2 seconds...");
//         setTimeout(() => {
//             location.reload(); // manually refresh
//         }, 2000);
//     }
// }); 
</script>
@endpush

@push('css')
  <style>
    /* Skeleton Loading Styles */
    .skeleton-loading   
    
    .loaded-content {
        display: none !important;
    }
    
    .skeleton-img {
        width: 100% ;
        height: auto ;
        background-color: #e0e0e0 !important;
        border-radius: 4px !important;
        margin-bottom: 10px !important;
        /* animation: skeleton-pulse 1.5s ease-in-out infinite; */
    }
    
    .skeleton-text {
        height: 12px;
        background-color: #e0e0e0 !important;
        border-radius: 4px !important;
        margin-bottom: 8px !important;
        animation: skeleton-pulse 1.5s ease-in-out infinite;
    }
    
    .skeleton-text:last-child {
        margin-bottom: 0 !important;
    }
    
    @keyframes skeleton-pulse {
        0% {
            opacity: 0.6;
        }
        50% {
            opacity: 1;
        }
        100% {
            opacity: 0.6;
        }
    }
    
    /* Make sure the skeleton cards match your news card styling */
    .news-card.skeleton, .featured-news-card.skeleton {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
  </style>  
@endpush



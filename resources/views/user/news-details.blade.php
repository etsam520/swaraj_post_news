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
    {{-- resources/views/user/news-details.blade.php --}}


    

   <div class="news-detail-main" id="news-detail-main">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 px-lg-3 px-0">
               <div class="news-detail-container skeleton">
                  <div class="news-detail-share">
                     <span>Share:</span>
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-x-twitter"></i></a>
                     <a href="#"><i class="fab fa-whatsapp"></i></a>
                  </div>
                  <div class="skeleton-img" style="width: 100%;height:350px !important;"></div>
                     
                  <div class="news-detail-title skeleton-text" id="news-detail-title" style="height: 50px;width:100%;">
                                           
                  </div>
                  <div class="news-detail-meta">
                     By <a href="#" class="skeleton-text" style="width:250px"></a>
                     <span class="d-flex">Published :
                     <div class="skeleton-text" style="width:250px"></div></span>
                  </div>
                  <div class="news-detail-content">
                     <p class="skeleton-text" style="width:100%;height:30px"><span class="dropcap"></span></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                     <p class="skeleton-text" style="width:100%;"></p>
                  </div>
                  <div class="news-detail-nav d-lg-flex justify-content-between mt-4 align-items-center"
                     style="gap: 10px;">
                     <div class="news-prev">
                        <div class="skeleton-img" style="width: 50px;height:50px;margin-right:10px !important;"></div>
                        <a href="#"
                           class="d-flex align-items-center text-decoration-none" style="color:#888;">
                           <div>
                              <div style="font-size:0.9rem;color:#bbb;"><i
                                 class="fa fa-arrow-left mr-2"></i>Prev Article</div>
                              <div class="skeleton-text" style="width: 150px;height: 50px"></div>
                           </div>
                        </a>
                     </div>
                     <div class="news-next">
                        <div class="skeleton-img" style="width: 50px;height:50px;margin-right:10px !important;"></div>

                        <a href="#"
                           class="d-flex align-items-center justify-content-end text-decoration-none"
                           style="color:#888;">
                           <div>
                              <div style="font-size:0.9rem;color:#bbb;text-align:right;">Next Article<i
                                 class="fa fa-arrow-right ml-2"></i></div>
                              <div class="skeleton-text" style="width: 150px;height: 50px"></div>
                           </div>

                        </a>
                     </div>
                  </div>
                  
                  <div id="ads_section"></div>
                  
               </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block px-lg-3 px-0">
               <div class="news-list-sidebar"
                  style="background:#fff;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.04);padding:20px 16px;">
                  <h5 style="font-weight:700;margin-bottom:18px;">Latest News</h5>
                  <ul class="list-unstyled" style="margin:0;padding:0;">
                     <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <div class="skeleton-img"
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;"></div>
                        <div>
                           <p class="skeleton-text" 
                              style="width:200px; font-weight:600;color:#222;text-decoration:none;"></p>
                           <div class="skeleton-text" style="font-size:0.95rem;color:#888;"></div>
                        </div>
                     </li>
                     <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <div class="skeleton-img"
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;"></div>
                        <div>
                           <p class="skeleton-text" 
                              style="width:200px; font-weight:600;color:#222;text-decoration:none;"></p>
                           <div class="skeleton-text" style="font-size:0.95rem;color:#888;"></div>
                        </div>
                     </li>
                      <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <div class="skeleton-img"
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;"></div>
                        <div>
                           <p class="skeleton-text" 
                              style="width:200px; font-weight:600;color:#222;text-decoration:none;"></p>
                           <div class="skeleton-text" style="font-size:0.95rem;color:#888;"></div>
                        </div>
                     </li>
                      <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                        <div class="skeleton-img"
                           style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;"></div>
                        <div>
                           <p class="skeleton-text" 
                              style="width:200px; font-weight:600;color:#222;text-decoration:none;"></p>
                           <div class="skeleton-text" style="font-size:0.95rem;color:#888;"></div>
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
    <script src="{{ asset('user/js/news-details.js') }}?v=2"></script>

    <script>
      var ads = @json($ads);
      function showAds(){
         $("#ads_section").append(`<hr>`);
         ads.forEach((ad) => {
            $("#ads_section").append(`
               <div class="mb-2">
                  <a href="${ad.link || '#'}" target="_blank">
                     <img src="${ad.cover_image_full}" alt="${ad.title}" class="img-fluid rounded">
                  </a>   
               </div>
            `);
         });
      };
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

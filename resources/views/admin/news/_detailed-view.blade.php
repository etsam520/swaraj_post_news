@extends('admin.layouts.admin_master')

@push('css')
    <style>
        /* body {
                                background-color: #f8f9fa;
                            }*/
        .news-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .news-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .news-content {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .video-container {
            margin-top: 20px;
        }
    </style>
@endpush

@section('containt')

    {{-- <div class="container-fluid vh-100 d-flex flex-column">
        <!-- News Header -->
        <div class="news-header">
            <h1>Breaking News: Market Crash</h1>
            <p class="mb-0">Published on: January 11, 2025 | By: John Doe</p>
        </div>

        <!-- Footer -->
        <footer class="text-center bg-light py-3">
            <p class="mb-0">&copy; 2025 News Portal. All Rights Reserved.</p>
        </footer>
    </div> --}}
    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Headlines</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">News</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Headline</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="container">
                    <div class="row">
                        <div class="card p-0">
                            <div class="news-header bg-purple-gradient radius-10">
                                <h1>{{$news->headline}}</h1>
                                <p class="mb-0">Published on:
                                    {{\Carbon\Carbon::parse($news->publish_at)->format('F j, Y g:i A') }} |
                                    By: {{Str::ucfirst($news->creator->name)}}
                                </p>
                            </div>
                            <div class="card-body p-lg-5 p-3">
                                <!-- News Image -->
                                <img src="{{ Storage::disk('s3')->url($news->image) }}" alt="News Image"
                                    class="news-image img-fluid radius-5">
                                <div class="row gutters-0 border">

                                    <!-- News Details -->
                                    <div class="col-md-9 p-lg-5 p-3">
                                        <div class="">
                                            <h2 class="text-primary fw-bolder mb-5">{{__("messages.headline")}}:
                                                {{$news->headline}}</h2>
                                            <blockquote class="blockquote">
                                                <p>"{{$news->quote}}"</p>
                                            </blockquote>
                                            <p>{!! $news->details !!}</p>
                                            <p><strong>{{__("messages.category")}}:</strong> {{$news->category_name}}</p>
                                            <p><strong>{{__("messages.city")}}:</strong>
                                                {{$news->city_name . ', ' . $news->state_name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 border-start p-lg-5 p-3">
                                        <h4
                                            class="text-danger fw-bolder text-center text-uppercase">
                                            Gallery Images</h4>
                                            <hr>
                                        @foreach ($news->gallery as $image)
                                            <img src="{{ Storage::disk('s3')->url($image->image_path) }}" alt="Gallery Image"
                                                class="mt-2 img-fluid" style="width: 100%">
                                        @endforeach
                                    </div>

                                </div>

                                @if ($news->video_link != null)

                                    <!-- Video Section -->
                                    <div class="row video-container">
                                        <div class="col-12">
                                            <h3 class="fw-bolder text-danger">Related Video</h3>
                                            <div class="ratio ratio-16x9">
                                                <iframe
                                                    src="{{Helpers::generateYoutubeEmbedUrl(Helpers::getYoutubeVideoId($news->video_link) ?? "") }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                            </div>
                                            {{-- <iframe src="https://www.youtube.com/embed/MIYQR-Ybrn4" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe> --}}
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @dd($news) --}}

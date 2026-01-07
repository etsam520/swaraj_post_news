@extends('user.layouts.main')


@section('containt')
    <div class="container-fluid bg-light">
        <div class="container">
            <nav aria-label="breadcrumb" style="padding: 14px 0;">
                <ol class="breadcrumb" style="background: none; padding: 0; margin: 0; font-size: 1.1rem;">
                    <li class="breadcrumb-item"><a href="{{url('/')}}" class="text-muted">Home</a></li>
                    <li class="breadcrumb-item active">{{ Str::ucfirst($category->category_name) }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="category-title">
            Category: <span style="font-family: inherit;">{{ Str::ucfirst($category->category_name) }}</span>
        </div>
        <div class="row blog-cards">
            @foreach ($newsList as $news)
            <div class="col-lg-4 col-md-6 col-12 d-flex px-lg-3 px-0">
                <div class="blog-card w-100">
                    <img src="{{Storage::disk('s3')->url($news->thumbnail)}}"
                        alt="{{Str::ucfirst($news->headline)}}">
                    <div class="blog-card-content">
                        <div class="blog-card-title">
                            <a href="{{route('news.details',['slug'=> $news->slug])}}">
                                {{Str::ucfirst($news->headline)}}
                            </a>
                        </div>
                        <div class="blog-card-meta">
                            <span>{{Helpers::stringToFormattedDate($news->created_at)}}</span>
                            <span>
                                <svg width="18" height="18" fill="none" stroke="#888" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M21 15a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2V3h2v2h4V3h2v2h2a2 2 0 0 1 2 2z" />
                                    <circle cx="12" cy="13" r="4" />
                                </svg>
                                {{rand(10,99)}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>

@endsection

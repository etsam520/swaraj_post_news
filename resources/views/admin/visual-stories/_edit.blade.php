@extends('admin.layouts.admin_master')

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">{{__('messages.add-visual-story')}}</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        <form action="{{ route('admin.visual-stories.update', $visualStory->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Headline in English -->
                                <div class="form-group">
                                    <label for="title_en" class="form-label text-dark">Title (English)</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                                           name="title_en" id="title_en" value="{{ $visualStory->translate('en')->title ?? old('title_en') }}">
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Headline in Hindi -->
                                <div class="form-group">
                                    <label for="title_hi" class="form-label text-dark">Title (Hindi)</label>
                                    <input type="text" class="form-control @error('title_hi') is-invalid @enderror"
                                           name="title_hi" id="title_hi" value="{{ $visualStory->translate('hi')->title ?? old('title_hi') }}">
                                    @error('title_hi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- News Image -->
                                <div class="form-group">
                                    <label for="cover_image" class="form-label text-dark">Cover Image</label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                                           name="cover_image" id="cover_image" accept="image/jpeg, image/png">
                                    @if($visualStory->cover_image)
                                        <img src="{{ asset('storage/'.$visualStory->cover_image) }}" style="width: 100px" alt="">
                                    @endif
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City Selection -->
                                <div class="form-group">
                                    <label for="city" class="form-label text-dark">City</label>
                                    <select class="form-control select2 form-select @error('city') is-invalid @enderror"
                                            name="city" id="city" data-placeholder="Select">
                                        <option value="" label="default">Select</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ ($visualStory->city_id ?? old('city')) == $city->id ? 'selected' : '' }}>
                                                {{ Str::ucfirst($city->city_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Video URL -->
                                <div class="card">
                                    <div><h5 class="text-muted">Slides</h5></div>
                                    <div class="card-body" id="slideContainer">
                                        @foreach (old('video_url', json_decode($visualStory->slides) ?? ['']) as $index => $video_url)
                                            <div class="slide slide-{{ $index }}">
                                                <div class="form-group flex-fill">
                                                    <label for="video_url_{{ $index }}" class="form-label text-dark">Slide {{ $index + 1 }}</label>
                                                    <input type="url" class="form-control @error('video_url.' . $index) is-invalid @enderror"
                                                           name="video_url[{{ $index }}]" id="video_url_{{ $index }}" placeholder="https://example.com"
                                                           value="{{ $video_url }}">
                                                    @error('video_url.' . $index)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="icons-list-wrap">
                                                    <ul class="icons-list">
                                                        <li type="button" onclick="addSlide()" class="icons-list-item"><i class="fa fa-plus-square"></i></li>
                                                        @if ($index != 0)
                                                            <li class="icons-list-item" type="button" onclick="removeSlide({{ $index }})"><i class="fa fa-remove"></i></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Details in English -->
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Description (English)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote @error('description_en') is-invalid @enderror"
                                                  name="description_en" id="desc_eng">{{ old('description_en', $visualStory->translate('en')->description ?? '') }}</textarea>
                                        @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Details in Hindi -->
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Description (Hindi)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote @error('description_hi') is-invalid @enderror"
                                                  name="description_hi" id="desc_hind">{{ old('description_hi', $visualStory->translate('hi')->description ?? '') }}</textarea>
                                        @error('description_hi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <!-- Submit Buttons -->
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary float-end mb-1 mb-sm-0" name="save" value="Save">
                                <input type="submit" name="save_as_draft" value="Save as Draft"
                                       class="btn btn-secondary float-end me-2 mb-1 mb-sm-0">
                                
                                <input type="submit" name="publish" value="Publish"
                                       class="btn btn-secondary float-end me-2 mb-1 mb-sm-0">
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
</div>
@endsection

@push('javascript')
<!-- INTERNAL Summernote Editor js -->
<script src="{{ asset('assets/plugins/summernote-editor/summernote1.js') }}"></script>
<script src="{{ asset('assets/js/summernote.js') }}"></script>
<script>
    $('#desc_eng').summernote({
        height: 120,
    });
    $('#desc_hind').summernote({
        height: 120,
    });

    let slideCount = {{ count(old('video_url', json_decode($visualStory->slides) ?? [''])) - 1 }};
    const slideContainer = document.getElementById('slideContainer');

    function addSlide() {
        slideCount++;
        const slideDiv = document.createElement('div');
        slideDiv.classList.add('slide', `slide-${slideCount}`);
        slideDiv.innerHTML = `
            <div class="form-group flex-fill">
                <label for="video_url_${slideCount}" class="form-label text-dark">Slide ${slideCount + 1}</label>
                <input type="url" class="form-control"
                       name="video_url[${slideCount}]" id="video_url_${slideCount}" placeholder="https://example.com">
            </div>
            <div class="icons-list-wrap">
                <ul class="icons-list">
                    <li type="button" onclick="addSlide()" class="icons-list-item"><i class="fa fa-plus-square"></i></li>
                    ${slideCount > 0 ? `<li class="icons-list-item" type="button" onclick="removeSlide(${slideCount})"><i class="fa fa-remove"></i></li>` : ''}
                </ul>
            </div>
        `;
        slideContainer.appendChild(slideDiv);
    }

    function removeSlide(slideNumber) {
        const slideToRemove = document.querySelector(`.slide-${slideNumber}`);
        if (slideToRemove) {
            slideContainer.removeChild(slideToRemove);
        }
    }

    if (slideCount === 0) {
        addSlide();
    }
</script>
@endpush

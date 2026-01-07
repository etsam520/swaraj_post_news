@extends('admin.layouts.admin_master')

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
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

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Add Visual Story</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('admin.visual-stories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title_en" class="form-label text-dark">Title (English)</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en" id="title_en" value="{{ old('title_en') }}">

                                </div>

                                <div class="form-group">
                                    <label for="title_hi" class="form-label text-dark">Title (Hindi)</label>
                                    <input type="text" class="form-control @error('title_hi') is-invalid @enderror" name="title_hi" id="title_hi" value="{{ old('title_hi') }}">

                                </div>
                                <div class="form-group">
                                    <label for="city" class="form-label text-dark">City</label>
                                    <select class="form-control select2 form-select @error('city') is-invalid @enderror"
                                            name="city" id="city" data-placeholder="Select">
                                        <option value="" label="default">Select</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city') == $city->id ? 'selected' : '' }}>
                                                {{ Str::ucfirst($city->city_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cover_image" class="form-label text-dark">Cover Image</label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" accept="image/*">
                                </div>

                                <div class="card">
                                    <div> <h5 class="text-muted">Slides</h5></div>
                                    <div class="card-body" id="slideContainer">
                                        <div class="slide slide-0">
                                            <div class="form-group flex-fill">
                                                <label class="form-label text-dark">Slide 1</label>
                                                <input type="file" class="form-control" name="media[0]" accept="image/*, video/*">
                                            </div>
                                            <div class="icons-list-wrap">
                                                <ul class="icons-list">
                                                    <li type="button" onclick="addSlide()" class="icons-list-item"><i class="fa fa-plus-square"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Description (English)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote" name="description_en" id="desc_eng">{{ old('description_en') }}</textarea>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Description (Hindi)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote" name="description_hi" id="desc_hind">{{ old('description_hi') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary float-end" name="save" value="Save">
                                <input type="submit" name="save_as_draft" value="Save as Draft" class="btn btn-secondary float-end me-2">

                                <input type="submit" name="publish" value="Publish" class="btn btn-secondary float-end me-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script>
    let slideCount = 0;
    const slideContainer = document.getElementById('slideContainer');

    function addSlide() {
        slideCount++;
        const slideDiv = document.createElement('div');
        slideDiv.classList.add('slide', `slide-${slideCount}`);
        slideDiv.innerHTML = `
            <div class="form-group flex-fill">
                <label class="form-label text-dark">Slide ${slideCount + 1}</label>
                <input type="file" class="form-control" name="media[${slideCount}]" accept="image/*, video/*">
            </div>
            <div class="icons-list-wrap">
                <ul class="icons-list">
                    <li type="button" onclick="addSlide()" class="icons-list-item"><i class="fa fa-plus-square"></i></li>
                    <li class="icons-list-item" type="button" onclick="removeSlide(${slideCount})"><i class="fa fa-remove"></i></li>
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
</script>
@endpush

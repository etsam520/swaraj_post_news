@extends('admin.layouts.admin_master')
@push('css')
<meta name=locale content="{{ app()->getLocale() }}">
@endpush

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">{{__('messages.ky')}}</h1>
                    {{-- <a href="{{ url()->current() }}?lang=hi">Hinei</a> --}}
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
                <div class="col-lg-12 col-md-12 col-md-12">
                    <div class="card ">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        {{-- <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <!-- Headline in English -->
                                <div class="form-group">
                                    <label for="headline_en" class="form-label text-dark">Head Line (English)</label>
                                    <input type="text" class="form-control @error('headline_en') is-invalid @enderror"
                                           name="headline_en" id="headline_en" value="{{ old('headline_en') }}">
                                    @error('headline_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Headline in Hindi -->
                                <div class="form-group">
                                    <label for="headline_hi" class="form-label text-dark">Head Line (Hindi)</label>
                                    <input type="text" class="form-control @error('headline_hi') is-invalid @enderror"
                                           name="headline_hi" id="headline_hi" value="{{ old('headline_hi') }}">
                                    @error('headline_hi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quote in English -->
                                <div class="form-group">
                                    <label for="quote_en" class="form-label text-dark">Quote (English)</label>
                                    <input type="text" class="form-control @error('quote_en') is-invalid @enderror"
                                           name="quote_en" id="quote_en" value="{{ old('quote_en') }}">
                                    @error('quote_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quote in Hindi -->
                                <div class="form-group">
                                    <label for="quote_hi" class="form-label text-dark">Quote (Hindi)</label>
                                    <input type="text" class="form-control @error('quote_hi') is-invalid @enderror"
                                           name="quote_hi" id="quote_hi" value="{{ old('quote_hi') }}">
                                    @error('quote_hi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category Selection -->
                                <div class="form-group">
                                    <label for="category" class="form-label text-dark">Category</label>
                                    <select class="form-control select2 form-select @error('category') is-invalid @enderror"
                                            name="category" id="category" data-placeholder="Select">
                                        <option value="" label="default">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ Str::ucfirst($category->category_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
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
                                                {{ old('city') == $city->id ? 'selected' : '' }}>
                                                {{ Str::ucfirst($city->city_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div class="form-group">
                                    <label for="tags" class="form-label text-dark">Tags</label>
                                    <select class="form-control select2 form-select @error('tags') is-invalid @enderror"
                                            name="tags[]" id="tags" data-placeholder="Select" multiple>
                                        <option value="" label="default">Select</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                                {{ Str::ucfirst($tag->tag_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Details in English -->
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Details (English)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote @error('details_en') is-invalid @enderror"
                                                  name="details_en" id="desc_eng">{{ old('details_en') }}</textarea>
                                        @error('details_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Details in Hindi -->
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Details (Hindi)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote @error('details_hi') is-invalid @enderror"
                                                  name="details_hi" id="desc_hind">{{ old('details_hi') }}</textarea>
                                        @error('details_hi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- File Upload -->
                                <div class="p-4 border mb-4 form-group">
                                    <label for="demo" class="form-label text-dark">Upload News Photo</label>
                                    <input type="file" class="form-control @error('news_photo') is-invalid @enderror"
                                           name="news_photo" id="demo" accept="image/jpeg, image/png" multiple>
                                    @error('news_photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Video URL -->
                                <div class="form-group">
                                    <label for="video_url" class="form-label text-dark">Video URL</label>
                                    <input type="url" class="form-control @error('video_url') is-invalid @enderror"
                                           name="video_url" id="video_url" placeholder="https://example.com"
                                           value="{{ old('video_url') }}">
                                    @error('video_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-end mb-1 mb-sm-0">Publish Now</button>
                                <button type="submit" name="save_as_draft"
                                        class="btn btn-secondary float-end me-2 mb-1 mb-sm-0">Save as Draft</button>
                            </div>
                        </form> --}}
                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                  {{-- Show all validation errors at the top --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                 <!-- Headline in English -->
                                 <div class="form-group">
                                    <label for="headline_en" class="form-label text-dark">Head Line (English)</label>
                                    <input type="text" class="form-control @error('headline_en') is-invalid @enderror"
                                           name="headline_en" id="headline_en" value="{{ old('headline_en') }}">
                                    @error('headline_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Headline in Hindi -->
                                <div class="form-group">
                                    <label for="headline_hi" class="form-label text-dark">Head Line (Hindi)</label>
                                    <input type="text" class="form-control @error('headline_hi') is-invalid @enderror"
                                           name="headline_hi" id="headline_hi" value="{{ old('headline_hi') }}">
                                    @error('headline_hi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quote in English -->
                                <div class="form-group">
                                    <label for="quote_en" class="form-label text-dark">Quote (English)</label>
                                    <input type="text" class="form-control @error('quote_en') is-invalid @enderror"
                                           name="quote_en" id="quote_en" value="{{ old('quote_en') }}">
                                    @error('quote_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quote in Hindi -->
                                <div class="form-group">
                                    <label for="quote_hi" class="form-label text-dark">Quote (Hindi)</label>
                                    <input type="text" class="form-control @error('quote_hi') is-invalid @enderror"
                                           name="quote_hi" id="quote_hi" value="{{ old('quote_hi') }}">
                                    @error('quote_hi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Thumbnail Image -->
                                <div class="form-group">
                                    <label for="thumbnail" class="form-label text-dark">Thumbnail Image</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                           name="thumbnail" id="thumbnail" accept="image/jpeg, image/png">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- News Image -->
                                <div class="form-group">
                                    <label for="news_image" class="form-label text-dark">News Image</label>
                                    <input type="file" class="form-control @error('news_image') is-invalid @enderror"
                                           name="news_image" id="news_image" accept="image/jpeg, image/png">
                                    @error('news_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- News Gallery (Multiple Images) -->
                                <div class="form-group">
                                    <label for="gallery" class="form-label text-dark">News Gallery (Multiple Images)</label>
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror"
                                           name="gallery[]" id="gallery" accept="image/jpeg, image/png" multiple>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category Selection -->
                                <div class="form-group">
                                    <label for="category" class="form-label text-dark">Category</label>
                                    <select class="form-control select2 form-select @error('category') is-invalid @enderror"
                                            name="category" id="category" data-placeholder=
                                            "Select">
                                        <option value="" label="default">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ Str::ucfirst($category->category_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City Selection -->
                                <div class="form-group">
                                    <label for="select-state" class="form-label text-dark">Select State</label>
                                    <select id="state-select" class="form-control  form-select">
                                        <option value="">— Select State —</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="select-city" class="form-label text-dark">Select City</label>
                                    <select id="city-select" class="form-select form-control" name="city" >
                                        <option value="">— Select City —</option>
                                    </select>
                                </div>

                                <!-- Tags -->
                                <div class="form-group">
                                    <label for="tags" class="form-label text-dark">Tags</label>
                                    <select class="form-control select2 form-select @error('tags') is-invalid @enderror"
                                            name="tags[]" id="tags" data-placeholder="Select" multiple>
                                        <option value="" label="default">Select</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                                {{ Str::ucfirst($tag->tag_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Details in English -->
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Details (English)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote @error('details_en') is-invalid @enderror"
                                                  name="details_en" id="desc_eng">{{ old('details_en') }}</textarea>
                                        @error('details_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Details in Hindi -->
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="card-title">Details (Hindi)</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote @error('details_hi') is-invalid @enderror"
                                                  name="details_hi" id="desc_hind">{{ old('details_hi') }}</textarea>
                                        @error('details_hi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Video URL -->
                                <div class="form-group">
                                    <label for="video_url" class="form-label text-dark">Video URL</label>
                                    <input type="url" class="form-control @error('video_url') is-invalid @enderror"
                                           name="video_url" id="video_url" placeholder="https://example.com"
                                           value="{{ old('video_url') }}">
                                    @error('video_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary float-end mb-1 mb-sm-0" name="save" value="Save" >
                                <input type="submit" name="save_as_draft" value="Save as Draft"
                                        class="btn btn-secondary float-end me-2 mb-1 mb-sm-0" />
                                @can('publish news')
                                <input type="submit" name="publish" value="Publish"
                                        class="btn btn-secondary float-end me-2 mb-1 mb-sm-0" />
                                @endcan
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
<script id="location-data" type="application/json">
    @json($states)
</script>

<script src="{{asset('assets/plugins/summernote-editor/summernote1.js')}}"></script>
<script src="{{asset('assets/js/summernote.js')}}"></script>
<script>
    $('#desc_eng').summernote({
        height:120,
    });
    $('#desc_hind').summernote({
        height:120,
    });

     const data = JSON.parse(
      document.getElementById('location-data').textContent
    );
    function getLocale() {
        return document.querySelector("meta[name='locale']").getAttribute("content");
    }

    const stateSelect = document.getElementById('state-select');
    const citySelect  = document.getElementById('city-select');

    // Populate states dropdown
    data.forEach(stateObj => {
        const translated_obj = stateObj.translations.find(t => t.locale === getLocale()) || stateObj.translations[0];
        const opt = document.createElement('option');
        opt.value = stateObj.id;
        opt.textContent = translated_obj.state_name;
        stateSelect.appendChild(opt);
    });

    // When the user selects a state...
    stateSelect.addEventListener('change', () => {
      const chosen = stateSelect.value;
      citySelect.innerHTML = '<option value="">— Select City —</option>';
      if (!chosen) {
        citySelect.disabled = true;
        return;
      }
      citySelect.disabled = false;
      // Find the state object
      let state = data.find(t => t.id == stateSelect.value)
        if (state) {
            const cities = state.cities.map(city => {
                const translation = city.translations.find(t => t.locale === getLocale());
                return {
                id: city.id,
                name: translation ? translation.city_name : city.city_name,
                slug: translation ? translation.city_slug : city.city_slug
                };
            });
            cities.forEach(city => {
                const opt = document.createElement('option');
                opt.value = city.id;
                opt.textContent = city.name;
                citySelect.appendChild(opt);
            });
        } else {
            console.log("State not found");
        }
    });
</script>

@endpush

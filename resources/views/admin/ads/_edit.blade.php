@extends('admin.layouts.admin_master')
@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Ad</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.ads.index') }}">ADS</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Edit Ad</h3>
                        </div>
                        {{-- Error Display --}}
                        @if ($errors->any())
                            <div class="alert alert-danger mb-0">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Form for updating the Ad --}}
                        <form action="{{ route('admin.ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- This tells Laravel to treat this as a PUT request --}}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title" class="form-label text-dark">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $ad->title) }}" placeholder="Enter ad title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="link" class="form-label text-dark">Ad Link (URL)</label>
                                    <input type="url" class="form-control @error('link') is-invalid @enderror" name="link" id="link" value="{{ old('link', $ad->link) }}" placeholder="e.g., https://www.example.com/ad-page">
                                    <small class="form-text text-muted">The URL this ad will direct to when clicked.</small>
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label text-dark">Ad Description/Content</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Enter a detailed description or content for the ad.">{{ old('description', $ad->description) }}</textarea>
                                    <small class="form-text text-muted">Additional text content for the advertisement.</small>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- City field remains hidden as per original code, but ensure old value or current ad value is used --}}
                                <div class="form-group d-none">
                                    <label for="city" class="form-label text-dark">City</label>
                                    <select class="form-control select2 form-select @error('city') is-invalid @enderror" name="city" id="city" data-placeholder="Select">
                                        <option value="" label="default">Select</option>
                                        {{-- Example: if you had cities to loop through --}}
                                        {{-- @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ old('city', $ad->city_id) == $city->id ? 'selected' : '' }}>
                                                {{ Str::ucfirst($city->city_name) }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cover_image" class="form-label text-dark">Cover Image</label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" accept="image/*">
                                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2" id="image-preview-container" style="{{ $ad->cover_image ? 'display: block;' : 'display: none;' }}">
                                        <p class="mb-1">Current Image:</p>
                                        <img id="cover-image-preview" src="{{ Helpers::getCloudImageUrl($ad->cover_image)  }}" alt="Cover Image Preview" style="max-width: 200px; height: auto; border: 1px solid #ddd; padding: 5px;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label text-dark">Status</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', $ad->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $ad->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-end">Update Ad</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const coverImageInput = document.getElementById('cover_image');
        const coverImagePreview = document.getElementById('cover-image-preview');
        const imagePreviewContainer = document.getElementById('image-preview-container');

        coverImageInput.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                coverImagePreview.src = URL.createObjectURL(file);
                imagePreviewContainer.style.display = 'block';
            } else {
                // If user clears selection, revert to existing image or hide
                if (coverImagePreview.dataset.originalSrc) { // If you store original src in data attribute
                    coverImagePreview.src = coverImagePreview.dataset.originalSrc;
                } else {
                    coverImagePreview.src = '#'; // Clear if no original
                    imagePreviewContainer.style.display = 'none'; // Hide if no original or new
                }
            }
        });

        // Store the initial image src so it can be reverted if the user cancels file selection
        if (coverImagePreview.src && coverImagePreview.src !== window.location.href + '#') {
            coverImagePreview.dataset.originalSrc = coverImagePreview.src;
        }
    });
</script>
@endpush

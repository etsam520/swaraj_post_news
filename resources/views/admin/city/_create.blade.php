@extends('admin.layouts.admin_master')

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Add City</h1>
                    {{-- <a href="{{ url()->current() }}?lang=hi">Hinei</a> --}}
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">City</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Add City</h3>
                        </div>
                        <form action="{{ route('admin.city.store') }}" method="POST" >
                            @csrf
                            <div class="card-body">
                                <!-- Name (English) -->
                                <div class="form-group">
                                    <label for="name_en" class="form-label text-dark">Name (En)</label>
                                    <input
                                        type="text"
                                        class="form-control @error('name_en') is-invalid @enderror"
                                        id="name_en"
                                        name="name_en"
                                        value="{{ old('name_en') }}"
                                    >
                                    <!-- Error Message -->
                                    @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Name (Hindi) -->
                                <div class="form-group">
                                    <label for="name_hi" class="form-label text-dark">Name (Hi)</label>
                                    <input
                                        type="text"
                                        class="form-control @error('name_hi') is-invalid @enderror"
                                        id="name_hi"
                                        name="name_hi"
                                        value="{{ old('name_hi') }}"
                                    >
                                    <!-- Error Message -->
                                    @error('name_hi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-end mb-1 mb-sm-0">Save</button>
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

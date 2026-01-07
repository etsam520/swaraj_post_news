@extends('admin.layouts.admin_master')

@section('containt')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Cities Tables</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cities Tables</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Add City</h3>
                        </div>
                        <form action="{{ route('admin.city.store') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="state_id" value="{{ $state_id }}">
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <h3 class="card-title">City Table</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">Id</th>
                                            <th class="wd-15p border-bottom-0">Name</th>
                                            <th class="wd-20p border-bottom-0">Name(Hi)</th>
                                            <th class="wi-20- border-bottom-0">Action</th>
                                            {{-- <th class="wd-15p border-bottom-0">Start date</th>
                                            <th class="wd-10p border-bottom-0">Salary</th>
                                            <th class="wd-25p border-bottom-0">E-mail</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($cities as $city)
                                        <tr>
                                        <td>{{$city->id}}</td>
                                        <td>{{$city->translate('en')?->city_name}}</td>
                                        <td>{{$city->translate('hi')?->city_name}}</td>
                                        <td style="width:100px;"><div class="d-flex justify-content-between" >
                                            <form action="{{ route('admin.city.destroy',['id' => $city->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this City item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fe fe-trash"></i></button>
                                            </form>
                                            <a class="btn btn-primary fs-14 text-white edit-icn" title="Edit" href="{{route('admin.city.edit',['id' => $city->id])}}">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                        </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection

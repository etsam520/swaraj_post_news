@extends('admin.layouts.admin_master')

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Add Permission</h1>
                    {{-- <a href="{{ url()->current() }}?lang=hi">Hinei</a> --}}
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Permission</a></li>
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
                            <h3 class="card-title">Add Permission</h3>
                        </div>
                        <form action="{{ route('admin.user.permissions.store') }}" method="POST" >
                            @csrf
                            <div class="card-body">
                                <!-- Name (English) -->
                                <div class="form-group">
                                    <label for="Permission_name" class="form-label text-dark">Permission Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('permission_name') is-invalid @enderror"
                                        id="Permission_name"
                                        name="permission_name"
                                        value="{{ old('permission_name') }}"
                                    >
                                    <!-- Error Message -->
                                    @error('permission_name')
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

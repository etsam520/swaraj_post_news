@extends('admin.layouts.admin_master')

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Add Role</h1>
                    {{-- <a href="{{ url()->current() }}?lang=hi">Hinei</a> --}}
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Role</a></li>
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
                            <h3 class="card-title">Add Role</h3>
                        </div>
                        <form action="{{ route('admin.user.roles.store') }}" method="POST" >
                            @csrf
                            <div class="card-body">
                                <!-- Name (English) -->
                                <div class="form-group">
                                    <label for="role_name" class="form-label text-dark">Role Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('role_name') is-invalid @enderror"
                                        id="role_name"
                                        name="role_name"
                                        value="{{ old('role_name') }}"
                                    >
                                    <!-- Error Message -->
                                    @error('role_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div class="form-group">
                                    <label for="permissions" class="form-label text-dark">Permissions</label>
                                    <select class="form-control select2 form-select @error('permissions') is-invalid @enderror"
                                            name="permissions[]" id="permissions" data-placeholder="Select" multiple>
                                        <option value="" label="default">Select</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name}}"
                                                {{ collect(old('tags'))->contains($permission->name) ? 'selected' : '' }}>
                                                {{ Str::ucfirst($permission->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('permissions')
                                        <div class="invalid-feedback">{{ $message }}</div>
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

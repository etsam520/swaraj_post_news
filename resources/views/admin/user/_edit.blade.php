@extends('admin.layouts.admin_master')

@section('containt')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit User</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name" class="form-label text-dark">Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                    >
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" class="form-label text-dark">Email</label>
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                    >
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone_number" class="form-label text-dark">Phone Number</label>
                                    <input
                                        type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number"
                                        name="phone_number"
                                        value="{{ old('phone_number', $user->phone_number) }}"
                                    >
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="form-group">
                                    <label for="gender" class="form-label text-dark">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group">
                                    <label for="dob" class="form-label text-dark">Date of Birth</label>
                                    <input
                                        type="date"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        id="dob"
                                        name="dob"
                                        value="{{ old('dob', $user->date_of_birth) }}"
                                    >
                                    @error('dob')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Profile Photo -->
                                <div class="form-group">
                                    <label for="profile_photo" class="form-label text-dark">Profile Photo</label>
                                    <input
                                        type="file"
                                        class="form-control @error('profile_photo') is-invalid @enderror"
                                        id="profile_photo"
                                        name="profile_photo"
                                    >
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/'.$user->profile_photo) }}" width="100" height="100" alt="Profile Photo">
                                    @endif
                                    @error('profile_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status" class="form-label text-dark">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Roles -->
                                <div class="form-group">
                                    <label for="roles" class="form-label text-dark">Roles</label>
                                    <select class="form-control @error('roles') is-invalid @enderror" name="roles[]" id="roles" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
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

@push('javascript')

@endpush

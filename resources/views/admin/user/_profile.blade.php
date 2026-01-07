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
                        <h1 class="page-title">Profile</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row" id="user-profile">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xl-6">
                                        <div class="d-flex flex-wrap align-items-center">
                                            @if($user->profile_photo)
                                            <div class="profile-img-main rounded">
                                                <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="Profile Photo" class="m-0 p-1 rounded hrem-6">
                                            </div>
                                            @endif
                                            <div class="ms-4">
                                                <h4>{{Str::ucfirst($user->name)}}</h4>
                                                <p class="text-muted mb-2">Member Since: {{Helpers::stringToFormattedDate($user->created_at)}}</p>
                                                {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-rss"></i> Follow</a>
                                                <a href="mail-inbox.html" class="btn btn-secondary btn-sm"><i class="fa fa-envelope"></i> E-mail</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xl-6">
                                        <div class="d-md-flex flex-wrap justify-content-lg-end">
                                            <div class="media m-3">
                                                <div class="media-icon bg-primary me-3 mt-1">
                                                    <i class="fe fe-file-plus fs-20 text-white"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">News Post</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$data['news_count']}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="wideget-user-tab">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <ul class="nav">
                                                <li><a href="#profileMain" class="active show" data-bs-toggle="tab">Profile</a></li>
                                                <li><a href="#editProfile" data-bs-toggle="tab">Edit Profile</a></li>
                                                {{-- <li><a href="#timeline" data-bs-toggle="tab">Timeline</a></li>
                                                <li><a href="#gallery" data-bs-toggle="tab">Gallery</a></li>
                                                <li><a href="#friends" data-bs-toggle="tab">Friends</a></li>
                                                <li><a href="#accountSettings" data-bs-toggle="tab">Account Settings</a></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="profileMain">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-5">
                                            <h3 class="card-title">Biodata</h3>
                                            <p class="text-dark-light">{{$user->details->biography??''}}</p>
                                        </div>

                                        <div class="table-responsive p-5">
                                            <h3 class="card-title">Personal Info</h3>
                                            <table class="table row table-borderless">
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Full Name :</strong> {{Str::ucfirst($user->name)}}</td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="col-lg-12 col-xl-6 p-0 border-top-0">
                                                    <tr>
                                                        <td><strong>Email :</strong> {{$user->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Phone :</strong> {{$user->phone_number}} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="border-top"></div>
                                        <div class="p-5">
                                            <h3 class="card-title">Social</h3>
                                            <div class="d-md-flex">
                                                @if($user->details->github??null)
                                                <div>
                                                    <div class="main-profile-contact-list">
                                                        <div class="media mx-2">
                                                            <div class="media-icon bg-primary-transparent text-primary"> <i class="fe fe-github fs-21"></i> </div>
                                                            <div class="media-body ms-2">
                                                                <span class="text-muted">Github</span>
                                                                <p class="mb-0"> <a href="{{$user->details->github??null}}" class="text-default">{{$user->details->github??null}}</a> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($user->details->twitter??'')
                                                <div>
                                                    <div class="main-profile-contact-list">
                                                        <div class="media mx-2">
                                                            <div class="media-icon bg-success-transparent text-success"> <i class="fe fe-twitter fs-21"></i> </div>
                                                            <div class="media-body ms-2">
                                                                <span class="text-muted">Twitter</span>
                                                                <p class="mb-0"> <a href="{{$user->details->twitter}}" class="text-default">{{$user->details->twitter}}</a> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($user->details->linkdin??'')
                                                <div>
                                                    <div class="main-profile-contact-list">
                                                        <div class="media mx-2">
                                                            <div class="media-icon bg-info-transparent text-info"> <i class="fe fe-linkedin fs-21"></i> </div>
                                                            <div class="media-body ms-2">
                                                                <span class="text-muted">Linkedin</span>
                                                                <p class="mb-0"> <a href="{{$user->details->linkdin}}" class="text-default">{{$user->details->linkdin}}</a> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="editProfile">
                                <div class="card">
                                    <div class="card-body border-0">
                                        <div id="messageUpdateProfile" class="alert d-none"></div>
                                        <form class="form-horizontal" id="userUpdateForm">
                                            <div class="row mb-4">
                                                <p class="mb-4 text-17">Personal Info</p>
                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <div class="form-group">
                                                        <label for="username" class="form-label">User Name</label>
                                                        <input type="text" class="form-control" name="name" id="username" value="{{$user->name}}">
                                                    </div>
                                                </div>
                                                  <!-- Date of Birth -->
                                                <div class="col-md-12 col-lg-12 col-xl-6">
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
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-6">
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
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <p class="mb-4 text-17">Contact Info</p>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$user->email}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="phoneNumber" class="form-label">Phone</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="phoneNumber" placeholder="phone number" name="phone" value="{{$user->phone_number}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="address" class="form-label">Address</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Address">{{$user->details->address??''}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4 text-17">Social Info</p>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="twitter" class="form-label">Twitter</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="twitter" value="{{$user->details->twitter??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="facebook" class="form-label">Facebook</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder="facebook" value="{{$user->details->facebook??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="googlePlus" name="google" class="form-label">Google+</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="googlePlus" placeholder="google" value="{{$user->details->google??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="linkedin" class="form-label">Linkedin</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="linkdin" id="linkedin" placeholder="linkedin" value="{{$user->details->linkdin??""}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="github" class="form-label">Github</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="github" id="github" placeholder="github" value="{{$user->details->github??""}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4 text-17">About Yourself</p>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="biographicalInfo" class="form-label">Biographical Info</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" name="biography" id="biographicalInfo" rows="4" placeholder="">{{$user->details->biography??""}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline">
                                <div class="row row-sm">
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-header border-bottom d-block p-4">
                                                <div class="media overflow-visible">
                                                    <div class="media-user me-2">
                                                        <div class="main-img-user"><img alt="" class="rounded-circle avatar-md" src="../assets/images/faces/6.jpg"></div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 ms-2">Mintrona Pechon Pechon</h6><span class="text-primary ms-2">just now</span>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show main-contact-star">
                                                            <a class="new option-dots2" data-bs-toggle="dropdown" href="JavaScript:void(0);"><i class="fe fe-more-vertical  tx-18"></i></a>
                                                            <div class="dropdown-menu shadow">
                                                                <a class="dropdown-item" href="#">Edit Post</a>
                                                                <a class="dropdown-item" href="#">Delete Post</a>
                                                                <a class="dropdown-item" href="#">Personal Settings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                </p>
                                                <div class="row row-sm">
                                                    <div class="col">
                                                        <img alt="img" class="h-200 mb-2 mt-2 me-4 br-5" src="../assets/images/media/timeline1.jpg">
                                                        <img alt="img" class="h-200 br-5" src="../assets/images/media/timeline2.jpg">
                                                    </div>
                                                </div>
                                                <div class="media mt-4 profile-footer align-items-center">
                                                    <div class="avatar-list avatar-list-stacked me-4">
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/8.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/7.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/9.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/14.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/11.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius bg-primary">+8</span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 text-bold text-dark-light">28 people like your photo</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border">
                                            <div class="card-header border-bottom d-block p-4">
                                                <div class="media overflow-visible">
                                                    <div class="media-user me-2">
                                                        <div class="main-img-user"><img alt="" class="rounded-circle avatar-md" src="../assets/images/faces/6.jpg"></div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 ms-2">Mintrona Pechon Pechon</h6><span class="text-primary ms-2">just now</span>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show main-contact-star">
                                                            <a class="new option-dots2" data-bs-toggle="dropdown" href="JavaScript:void(0);"><i class="fe fe-more-vertical  tx-18"></i></a>
                                                            <div class="dropdown-menu shadow">
                                                                <a class="dropdown-item" href="#">Edit Post</a>
                                                                <a class="dropdown-item" href="#">Delete Post</a>
                                                                <a class="dropdown-item" href="#">Personal Settings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                </p>
                                                <div class="row row-sm">
                                                    <div class="col">
                                                        <img alt="img" class="h-200 mb-2 mt-2 me-4 br-5" src="../assets/images/media/timeline3.jpg">
                                                        <img alt="img" class="h-200 br-5" src="../assets/images/media/timeline4.jpg">
                                                    </div>
                                                </div>
                                                <div class="media mt-4 profile-footer align-items-center">
                                                    <div class="avatar-list avatar-list-stacked me-4">
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/8.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/7.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/9.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/14.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/11.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius bg-primary">+8</span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 text-bold text-dark-light">28 people like your photo</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border">
                                            <div class="card-header border-bottom d-block p-4">
                                                <div class="media overflow-visible">
                                                    <div class="media-user me-2">
                                                        <div class="main-img-user"><img alt="" class="rounded-circle avatar-md" src="../assets/images/faces/6.jpg"></div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 ms-2">Mintrona Pechon Pechon</h6><span class="text-primary ms-2">just now</span>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show main-contact-star">
                                                            <a class="new option-dots2" data-bs-toggle="dropdown" href="JavaScript:void(0);"><i class="fe fe-more-vertical  tx-18"></i></a>
                                                            <div class="dropdown-menu shadow">
                                                                <a class="dropdown-item" href="#">Edit Post</a>
                                                                <a class="dropdown-item" href="#">Delete Post</a>
                                                                <a class="dropdown-item" href="#">Personal Settings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                </p>
                                                <div class="row row-sm">
                                                    <div class="col">
                                                        <img alt="img" class="h-200 mb-2 mt-2 me-4 br-5" src="../assets/images/media/timeline5.jpg">
                                                        <img alt="img" class="h-200 br-5" src="../assets/images/media/timeline6.jpg">
                                                    </div>
                                                </div>
                                                <div class="media mt-4 profile-footer align-items-center">
                                                    <div class="avatar-list avatar-list-stacked me-4">
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/8.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/7.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/9.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/14.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/11.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius bg-primary">+8</span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 text-bold text-dark-light">28 people like your photo</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header border-bottom d-block p-4">
                                                <div class="media overflow-visible">
                                                    <div class="media-user me-2">
                                                        <div class="main-img-user"><img alt="" class="rounded-circle avatar-md" src="../assets/images/faces/6.jpg"></div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 ms-2">Mintrona Pechon Pechon</h6><span class="text-primary ms-2">just now</span>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show main-contact-star">
                                                            <a class="new option-dots2" data-bs-toggle="dropdown" href="JavaScript:void(0);"><i class="fe fe-more-vertical  tx-18"></i></a>
                                                            <div class="dropdown-menu shadow">
                                                                <a class="dropdown-item" href="#">Edit Post</a>
                                                                <a class="dropdown-item" href="#">Delete Post</a>
                                                                <a class="dropdown-item" href="#">Personal Settings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                </p>
                                                <div class="row row-sm">
                                                    <div class="col">
                                                        <img alt="img" class="h-200 mb-2 mt-2 me-4 br-5" src="../assets/images/media/timeline7.jpg">
                                                        <img alt="img" class="h-200 br-5" src="../assets/images/media/timeline9.jpg">
                                                    </div>
                                                </div>
                                                <div class="media mt-4 profile-footer align-items-center">
                                                    <div class="avatar-list avatar-list-stacked me-4">
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/8.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/7.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/9.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/14.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius cover-image" data-bs-image-src= "../assets/images/users/11.jpg"></span>
                                                        <span class="avatar avatar-md rounded-circle bradius bg-primary">+8</span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 text-bold text-dark-light">28 people like your photo</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="gallery">
                                <div class="row  mb-5 img-gallery" id="lightgallery">
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/8.jpg" data-src="../assets/images/media/8.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/8.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/10.jpg" data-src="../assets/images/media/10.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/10.jpg" alt="banner image "></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/11.jpg" data-src="../assets/images/media/11.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/11.jpg" alt="banner image "></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/12.jpg" data-src="../assets/images/media/12.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/12.jpg" alt="banner image "></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/13.jpg" data-src="../assets/images/media/13.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/13.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/14.jpg" data-src="../assets/images/media/14.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/14.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/15.jpg" data-src="../assets/images/media/15.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/15.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/16.jpg" data-src="../assets/images/media/16.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/16.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/17.jpg" data-src="../assets/images/media/17.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/17.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/18.jpg" data-src="../assets/images/media/18.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/18.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/19.jpg" data-src="../assets/images/media/19.jpg">
                                        <a href="#"><img class="img-fluid wp-100 mb-2 br-5" src="../assets/images/media/19.jpg " alt="banner image"></a>
                                    </div>
                                    <div class="col-lg-3 col-md-6" data-responsive="../assets/images/media/20.jpg" data-src="../assets/images/media/20.jpg">
                                        <a href="#"><img class="img-fluid wp-100 br-5" src="../assets/images/media/20.jpg " alt="banner image"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="friends">
                                <div class="row row-sm">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/1.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Lisbon Taylor</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body  user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/11.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">jordan Ramsay</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body  user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/12.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Corey Richard</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body  user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/5.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Lana Del Rey</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/7.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Mariana Gold</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body  user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/13.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Travis Bickle</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body  user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/8.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Emilie Benett</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card custom-card border">
                                            <div class="card-body  user-lock text-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical text-muted"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow"> <a class="dropdown-item" href="#"><i class="fe fe-message-square me-2"></i> Message</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-edit-2 me-2"></i> Edit</a> <a class="dropdown-item" href="#"><i class="fe fe-eye me-2"></i> View</a> <a class="dropdown-item" href="#"><i
                                                                class="fe fe-trash-2 me-2"></i> Delete</a> </div>
                                                </div>
                                                <a href="#">
                                                    <img alt="avatar" class="avatar avatar-xl rounded" src="../assets/images/faces/4.jpg">
                                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">James Thomas</h4>
                                                    <span class="text-muted">Web designer</span>
                                                </a>
                                                <div class="footer-container-main border-0 my-2">
                                                    <div class="footer p-0 icons-bg border-0">
                                                        <div class="social">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a class="social-icon" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="accountSettings">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form-horizontal" data-select2-id="11">
                                            <div class="mb-4 main-content-label">Account</div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="userName" class="form-label">User Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="userName" placeholder="User Name" value="Elena Gilbert">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="eMail" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="eMail" placeholder="Email" value="info@elenagilbert.in">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group " data-select2-id="108">
                                                <div class="row" data-select2-id="107">
                                                    <div class="col-md-3">
                                                        <label for="language" class="form-label">Language</label>
                                                    </div>
                                                    <div class="col-md-9" data-select2-id="106">
                                                        <select class="form-control select2" id="language" tabindex="-1" aria-hidden="true">
                                                            <option>Us English</option>
                                                            <option>Arabic</option>
                                                            <option>Korean</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group " data-select2-id="10">
                                                <div class="row" data-select2-id="9">
                                                    <div class="col-md-3">
                                                        <label for="timeZone" class="form-label">Timezone</label>
                                                    </div>
                                                    <div class="col-md-9" data-select2-id="8">
                                                        <select class="form-control select2" id="timeZone" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                            <option value="Pacific/Midway" data-select2-id="6">(GMT-11:00) Midway Island, Samoa</option>
                                                            <option value="America/Adak" data-select2-id="16">(GMT-10:00) Hawaii-Aleutian</option>
                                                            <option value="Etc/GMT+10" data-select2-id="17">(GMT-10:00) Hawaii</option>
                                                            <option value="Pacific/Marquesas" data-select2-id="18">(GMT-09:30) Marquesas Islands</option>
                                                            <option value="Pacific/Gambier" data-select2-id="19">(GMT-09:00) Gambier Islands</option>
                                                            <option value="America/Anchorage" data-select2-id="20">(GMT-09:00) Alaska</option>
                                                            <option value="America/Ensenada" data-select2-id="21">(GMT-08:00) Tijuana, Baja California</option>
                                                            <option value="Etc/GMT+8" data-select2-id="22">(GMT-08:00) Pitcairn Islands</option>
                                                            <option value="America/Los_Angeles" data-select2-id="23">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                                            <option value="America/Denver" data-select2-id="24">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                                            <option value="America/Chihuahua" data-select2-id="25">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                            <option value="America/Dawson_Creek" data-select2-id="26">(GMT-07:00) Arizona</option>
                                                            <option value="America/Belize" data-select2-id="27">(GMT-06:00) Saskatchewan, Central America</option>
                                                            <option value="America/Cancun" data-select2-id="28">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                            <option value="Chile/EasterIsland" data-select2-id="29">(GMT-06:00) Easter Island</option>
                                                            <option value="America/Chicago" data-select2-id="30">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                                            <option value="America/New_York" data-select2-id="31">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                                            <option value="America/Havana" data-select2-id="32">(GMT-05:00) Cuba</option>
                                                            <option value="America/Bogota" data-select2-id="33">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                            <option value="America/Caracas" data-select2-id="34">(GMT-04:30) Caracas</option>
                                                            <option value="America/Santiago" data-select2-id="35">(GMT-04:00) Santiago</option>
                                                            <option value="America/La_Paz" data-select2-id="36">(GMT-04:00) La Paz</option>
                                                            <option value="Atlantic/Stanley" data-select2-id="37">(GMT-04:00) Faukland Islands</option>
                                                            <option value="America/Campo_Grande" data-select2-id="38">(GMT-04:00) Brazil</option>
                                                            <option value="America/Goose_Bay" data-select2-id="39">(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                                            <option value="America/Glace_Bay" data-select2-id="40">(GMT-04:00) Atlantic Time (Canada)</option>
                                                            <option value="America/St_Johns" data-select2-id="41">(GMT-03:30) Newfoundland</option>
                                                            <option value="America/Araguaina" data-select2-id="42">(GMT-03:00) UTC-3</option>
                                                            <option value="America/Montevideo" data-select2-id="43">(GMT-03:00) Montevideo</option>
                                                            <option value="America/Miquelon" data-select2-id="44">(GMT-03:00) Miquelon, St. Pierre</option>
                                                            <option value="America/Godthab" data-select2-id="45">(GMT-03:00) Greenland</option>
                                                            <option value="America/Argentina/Buenos_Aires" data-select2-id="46">(GMT-03:00) Buenos Aires</option>
                                                            <option value="America/Sao_Paulo" data-select2-id="47">(GMT-03:00) Brasilia</option>
                                                            <option value="America/Noronha" data-select2-id="48">(GMT-02:00) Mid-Atlantic</option>
                                                            <option value="Atlantic/Cape_Verde" data-select2-id="49">(GMT-01:00) Cape Verde Is.</option>
                                                            <option value="Atlantic/Azores" data-select2-id="50">(GMT-01:00) Azores</option>
                                                            <option value="Europe/Belfast" data-select2-id="51">(GMT) Greenwich Mean Time : Belfast</option>
                                                            <option value="Europe/Dublin" data-select2-id="52">(GMT) Greenwich Mean Time : Dublin</option>
                                                            <option value="Europe/Lisbon" data-select2-id="53">(GMT) Greenwich Mean Time : Lisbon</option>
                                                            <option value="Europe/London" data-select2-id="54">(GMT) Greenwich Mean Time : London</option>
                                                            <option value="Africa/Abidjan" data-select2-id="55">(GMT) Monrovia, Reykjavik</option>
                                                            <option value="Europe/Amsterdam" data-select2-id="56">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                            <option value="Europe/Belgrade" data-select2-id="57">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                            <option value="Europe/Brussels" data-select2-id="58">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                            <option value="Africa/Algiers" data-select2-id="59">(GMT+01:00) West Central Africa</option>
                                                            <option value="Africa/Windhoek" data-select2-id="60">(GMT+01:00) Windhoek</option>
                                                            <option value="Asia/Beirut" data-select2-id="61">(GMT+02:00) Beirut</option>
                                                            <option value="Africa/Cairo" data-select2-id="62">(GMT+02:00) Cairo</option>
                                                            <option value="Asia/Gaza" data-select2-id="63">(GMT+02:00) Gaza</option>
                                                            <option value="Africa/Blantyre" data-select2-id="64">(GMT+02:00) Harare, Pretoria</option>
                                                            <option value="Asia/Jerusalem" data-select2-id="65">(GMT+02:00) Jerusalem</option>
                                                            <option value="Europe/Minsk" data-select2-id="66">(GMT+02:00) Minsk</option>
                                                            <option value="Asia/Damascus" data-select2-id="67">(GMT+02:00) Syria</option>
                                                            <option value="Europe/Moscow" data-select2-id="68">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                            <option value="Africa/Addis_Ababa" data-select2-id="69">(GMT+03:00) Nairobi</option>
                                                            <option value="Asia/Tehran" data-select2-id="70">(GMT+03:30) Tehran</option>
                                                            <option value="Asia/Dubai" data-select2-id="71">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                            <option value="Asia/Yerevan" data-select2-id="72">(GMT+04:00) Yerevan</option>
                                                            <option value="Asia/Kabul" data-select2-id="73">(GMT+04:30) Kabul</option>
                                                            <option value="Asia/Yekaterinburg" data-select2-id="74">(GMT+05:00) Ekaterinburg</option>
                                                            <option value="Asia/Tashkent" data-select2-id="75">(GMT+05:00) Tashkent</option>
                                                            <option value="Asia/Kolkata" data-select2-id="76">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                            <option value="Asia/Katmandu" data-select2-id="77">(GMT+05:45) Kathmandu</option>
                                                            <option value="Asia/Dhaka" data-select2-id="78">(GMT+06:00) Astana, Dhaka</option>
                                                            <option value="Asia/Novosibirsk" data-select2-id="79">(GMT+06:00) Novosibirsk</option>
                                                            <option value="Asia/Rangoon" data-select2-id="80">(GMT+06:30) Yangon (Rangoon)</option>
                                                            <option value="Asia/Bangkok" data-select2-id="81">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                            <option value="Asia/Krasnoyarsk" data-select2-id="82">(GMT+07:00) Krasnoyarsk</option>
                                                            <option value="Asia/Hong_Kong" data-select2-id="83">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                            <option value="Asia/Irkutsk" data-select2-id="84">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                            <option value="Australia/Perth" data-select2-id="85">(GMT+08:00) Perth</option>
                                                            <option value="Australia/Eucla" data-select2-id="86">(GMT+08:45) Eucla</option>
                                                            <option value="Asia/Tokyo" data-select2-id="87">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                            <option value="Asia/Seoul" data-select2-id="88">(GMT+09:00) Seoul</option>
                                                            <option value="Asia/Yakutsk" data-select2-id="89">(GMT+09:00) Yakutsk</option>
                                                            <option value="Australia/Adelaide" data-select2-id="90">(GMT+09:30) Adelaide</option>
                                                            <option value="Australia/Darwin" data-select2-id="91">(GMT+09:30) Darwin</option>
                                                            <option value="Australia/Brisbane" data-select2-id="92">(GMT+10:00) Brisbane</option>
                                                            <option value="Australia/Hobart" data-select2-id="93">(GMT+10:00) Hobart</option>
                                                            <option value="Asia/Vladivostok" data-select2-id="94">(GMT+10:00) Vladivostok</option>
                                                            <option value="Australia/Lord_Howe" data-select2-id="95">(GMT+10:30) Lord Howe Island</option>
                                                            <option value="Etc/GMT-11" data-select2-id="96">(GMT+11:00) Solomon Is., New Caledonia</option>
                                                            <option value="Asia/Magadan" data-select2-id="97">(GMT+11:00) Magadan</option>
                                                            <option value="Pacific/Norfolk" data-select2-id="98">(GMT+11:30) Norfolk Island</option>
                                                            <option value="Asia/Anadyr" data-select2-id="99">(GMT+12:00) Anadyr, Kamchatka</option>
                                                            <option value="Pacific/Auckland" data-select2-id="100">(GMT+12:00) Auckland, Wellington</option>
                                                            <option value="Etc/GMT-12" data-select2-id="101">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                            <option value="Pacific/Chatham" data-select2-id="102">(GMT+12:45) Chatham Islands</option>
                                                            <option value="Pacific/Tongatapu" data-select2-id="103">(GMT+13:00) Nuku'alofa</option>
                                                            <option value="Pacific/Kiritimati" data-select2-id="104">(GMT+14:00) Kiritimati</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3 col">
                                                        <label class="form-label">Verification</label>
                                                    </div>
                                                    <div class="col-md-9 col d-flex">
                                                        <div class="custom-checkbox custom-control mx-2">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="Email">
                                                            <label for="Email" class="custom-control-label">Email</label>
                                                        </div>
                                                        <div class="custom-checkbox custom-control mx-2">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="Sms">
                                                            <label for="Sms" class="custom-control-label">Sms</label>
                                                        </div>
                                                        <div class="custom-checkbox custom-control mx-2">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="Phone">
                                                            <label for="Phone" class="custom-control-label">Phone</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 main-content-label">Secuirity Settings</div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Login Verification</label>
                                                    </div>
                                                    <div class="col-md-9"> <a href="#">Setup Verification</a> </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Password Verification</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="custom-checkbox custom-control mx-2">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="personal">
                                                            <label for="personal" class="custom-control-label">Required personal details</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="mb-4 main-content-label">Notifications</div>
                                                <div class="form-group mb-0">
                                                    <div class="row row-sm">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Configure Notifications</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <label class="d-block">
                                                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" checked>
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="text-muted ms-2">Allow all Notifications</span>
                                                            </label>
                                                            <label class="d-block">
                                                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="text-muted ms-2">Disable all Notifications</span>
                                                            </label>
                                                            <label class="d-block">
                                                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" checked>
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="text-muted ms-2">Notification Sounds</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group float-end">
                                                <div class="row row-sm">
                                                    <div class="col-md-12">
                                                        <a class="btn btn-info my-1" href="#">Change Password</a>
                                                        <a class="btn btn-outline-danger my-1" href="#">Deactivate Account</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- COL-END -->
                </div>
                <!-- ROW-1 CLOSED -->

            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->


    <!-- Country-selector modal-->
    <div class="modal fade" id="country-selector">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <ul class="row row-sm p-3">
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block active">
                                <span class="country-selector"><img alt="unitedstates" src="../assets/images/flags/us_flag.jpg" class="me-2 language"></span>United States
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="italy" src="../assets/images/flags/italy_flag.jpg" class="me-2 language"></span>Italy
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="spain" src="../assets/images/flags/spain_flag.jpg" class="me-2 language"></span>Spain
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="india" src="../assets/images/flags/india_flag.jpg" class="me-2 language"></span>India
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="french" src="../assets/images/flags/french_flag.jpg" class="me-2 language"></span>French
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="russia" src="../assets/images/flags/russia_flag.jpg" class="me-2 language"></span>Russia
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="germany" src="../assets/images/flags/germany_flag.jpg" class="me-2 language"></span>Germany
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="argentina" src="../assets/images/flags/argentina_flag.jpg" class="me-2 language"></span>Argentina
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="uae" src="../assets/images/flags/uae_flag.jpg" class="me-2 language"></span>UAE
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="austria" src="../assets/images/flags/austria_flag.jpg" class="me-2 language"></span>Austria
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="mexico" src="../assets/images/flags/mexico_flag.jpg" class="me-2 language"></span>Mexico
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="china" src="../assets/images/flags/china_flag.jpg" class="me-2 language"></span>China
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="poland" src="../assets/images/flags/poland_flag.jpg" class="me-2 language"></span>Poland
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="canada" src="../assets/images/flags/canada_flag.jpg" class="me-2 language"></span>Canada
                            </a>
                        </li>
                        <li class="col-lg-4 mb-2">
                            <a class="btn btn-country btn-lg btn-block">
                                <span class="country-selector"><img alt="malaysia" src="../assets/images/flags/malaysia_flag.jpg" class="me-2 language"></span>Malaysia
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Country-selector modal-->
@endsection

@push('javascript')
<script>
    document.getElementById("userUpdateForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent form submission
    const form = e.target ;

    // Clear any previous error messages
    const errors = document.querySelectorAll(".text-danger");
    errors.forEach(error => error.remove());

    let isValid = true;

    // Helper function to display error messages
    const showError = (element, message) => {
        const errorSpan = document.createElement("span");
        errorSpan.classList.add("text-danger");
        errorSpan.innerText = message;
        element.parentNode.appendChild(errorSpan);
    };

    // Validate user name
    const userName = document.getElementById("username");
    if (!userName.value.trim()) {
        showError(userName, "User name is required.");
        isValid = false;
    }

    // Validate date of birth
    const dob = document.getElementById("dob");
    if (!dob.value) {
        showError(dob, "Date of birth is required.");
        isValid = false;
    }

    // Validate email format
    const email = document.getElementById("email");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        showError(email, "Email is required.");
        isValid = false;
    } else if (!emailPattern.test(email.value)) {
        showError(email, "Invalid email format.");
        isValid = false;
    }

    // Validate phone number
    const phone = document.getElementById("phoneNumber");
    const phonePattern = /^[0-9\-\+]{9,15}$/;
    if (phone.value && !phonePattern.test(phone.value)) {
        showError(phone, "Invalid phone number format.");
        isValid = false;
    }

    // Validate social links
    const socialFields = ["twitter", "facebook", "googlePlus", "linkedin", "github"];
    const urlPattern = /^(https?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+(?:[\/\w\.-]*)*$/;

    socialFields.forEach(field => {
        const element = document.getElementById(field);
        if (element.value && !urlPattern.test(element.value)) {
            showError(element, `Invalid URL format for ${field}`);
            isValid = false;
        }
    });

    // Validate biography
    const biography = document.getElementById("biographicalInfo");
    if (!biography.value.trim()) {
        showError(biography, "Biographical information is required.");
        isValid = false;
    }

    // If all validations pass, submit the form
    if (isValid) {
        document.getElementById("messageUpdateProfile").classList.remove("d-none");
        document.getElementById("messageUpdateProfile").innerText = "Form submitted successfully.";
        // this.submit();
        submitProfileUpdateForm(form);
    } else {
        document.getElementById("messageUpdateProfile").classList.remove("d-none");
        document.getElementById("messageUpdateProfile").innerText = "Please fix the errors and try again.";
    }
});

async function submitProfileUpdateForm(form) {
    const formData = new FormData(form);

    try {
        const url = "{{route('admin.user.profile.update')}}";

        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        if (response.ok) {
            const result = await response.json();
            showMessage(result.message || "Account updated successfully!", "success");
        } else {
            const errorData = await response.json();
            if (errorData.errors) {
                handleValidationErrors(errorData.errors);
            } else {
                showMessage(errorData.error || "An error occurred. Please try again!", "danger");
            }
        }
    } catch (error) {
        console.error(error);
        showMessage("Server error. Please try again later!", "danger");
    }
}

function handleValidationErrors(errors) {
    // Clear previous errors
    document.querySelectorAll('.text-danger').forEach(el => el.remove());

    for (const [field, messages] of Object.entries(errors)) {
        const inputElement = document.querySelector(`[name="${field}"]`);
        if (inputElement) {
            const errorElement = document.createElement('span');
            errorElement.className = 'text-danger';
            errorElement.textContent = messages[0]; // Show only the first error message
            inputElement.closest('.form-group').appendChild(errorElement);
        }
    }
}

function showMessage(message, type) {
    const messageBox = document.getElementById('messageUpdateProfile');
    messageBox.textContent = message;
    messageBox.className = `alert alert-${type}`;
    messageBox.classList.remove('d-none');

    // Hide message after 3 seconds
    setTimeout(() => messageBox.classList.add('d-none'), 3000);
}
</script>

@endpush

@extends('admin.layouts.auth_master')

@section('containt')
<!-- PAGE -->
<div class="page">
    <div>
        <!-- CONTAINER OPEN -->
        <div class="col col-login mx-auto text-center">
            <a href="javascript:void(0)" class="text-center">
                <img src="{{asset('assets/images/brand/swaraj-post-logo.png')}}" style="height: 100px" class="header-brand-img" alt="">
            </a>
        </div>
        <div class="container-login100">
            <div class="wrap-login100 p-0">
                @if (session('status'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <form class="login100-form validate-form" method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <span class="login100-form-title">
                            Login
                        </span>

                        <!-- Email input -->
                        <div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" value="{{ old('email') }}" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                            </span>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                            <input class="input100" type="password" value="{{ old('password') }}" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                            </span>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Forgot Password link -->
                        <div class="text-end pt-1">
                            <p class="mb-0"><a href="{{ route('admin.password.request') }}" class="text-primary ms-1">Forgot Password?</a></p>
                        </div>

                        <!-- Remember Me checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="remember"> Remember Me </label>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-primary">
                                Login
                            </button>
                        </div>

                        <!-- Registration link -->
                        {{-- <div class="text-center pt-3">
                            <p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ms-1">Create an Account</a></p>
                        </div> --}}
                    </form>
                </div>

                <!-- Social login buttons -->
                {{-- <div class="card-footer">
                    <div class="d-flex justify-content-center my-3">
                        <a href="javascript:void(0)" class="social-login text-center me-4">
                            <i class="fa fa-google"></i>
                        </a>
                        <a href="javascript:void(0)" class="social-login text-center me-4">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="javascript:void(0)" class="social-login text-center">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!-- End PAGE -->
@endsection

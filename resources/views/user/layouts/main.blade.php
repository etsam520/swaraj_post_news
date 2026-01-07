@php
    $user = Auth('web')->user() ?? null;
@endphp
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Dynamic Title --}}
    <title>@yield('meta_title', 'Swaraj Post - Latest News, Breaking Updates, and Insights')</title>
    <meta name="description" content="@yield('meta_description', 'Get the latest news and insights from across India with Swaraj Post.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Swaraj Post, News, India, Latest News, Breaking News')">
    <meta name="author" content="Swaraj Post">
    <meta name="robots" content="index, follow">
    <meta name="application-name" content="Swaraj Post">
    <meta name="msapplication-TileColor" content="#2757fd">
    <meta name="msapplication-TileImage" content="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">
    <meta name="apple-mobile-web-app-title" content="Swaraj Post">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-config" content="{{ asset('assets/images/brand/browserconfig.xml') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">
    <link rel="icon" type="image/png" sizes="32x32" href="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">
    <link rel="icon" type="image/png" sizes="16x16" href="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">
    <link rel="manifest" href="{{ asset('assets/images/brand/site.webmanifest') }}">
    <link rel="mask-icon" href="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))" color="#2757fd">
    <link rel="shortcut icon" href="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">


    <link rel="icon" href="{{ asset('assets/images/brand/swaraj-post-logo.png') }}" type="image/x-icon">
    <meta name="theme-color" content="#2757fd">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">
    <meta name="hostname" content="{{ url('/') }}">
    <meta name="public_path" content="{{ asset('') }}">
    <meta name="google-site-verification" content="ZZxC3hPGjpsC1VjxCT2dICs2I_DXJVV7CmiDZmNFD3Y">

    {{-- Canonical --}}
    <link rel="canonical" href="@yield('meta_canonical', url()->current())" />

    {{-- Default Open Graph Tags (Can be overridden) --}}
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('meta_title', 'Swaraj Post – Latest News, Breaking Updates, and Insights')">
    <meta property="og:description" content="@yield('meta_description', 'Get the latest news and insights from across India with Swaraj Post.')">
    <meta property="og:url" content="@yield('meta_canonical', url()->current())">
    <meta property="og:site_name" content="Swaraj Post">
    <meta property="og:image" content="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', 'Swaraj Post')">
    <meta name="twitter:description" content="@yield('meta_description', 'Get the latest news and updates.')">
    <meta name="twitter:image" content="@yield('meta_image', asset('assets/images/brand/swaraj-post-default.jpg'))">
    <meta name="twitter:site" content="@SwarajPost">

    {{-- Extra Meta from child views --}}
    @stack('meta-data')


    <link rel="stylesheet" href="{{asset('user/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/magnific-popup.css')}}">
    <!-- <link rel="stylesheet" href="assets/fontawesome/css/all.min.css"> -->
    <link rel="stylesheet" href="{{asset('user/assets/css/dripicons.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Noto+Sans&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans&amp;display=swap">
        <style>
            body {
                font-family: 'Noto Sans', sans-serif !important;
                font-size: 16px !important;
            }
        </style>
    @stack('css')
</head>


<body>

    
    <!-- Header start -->
    @include('user.layouts.header')

    @yield('containt')

    <!-- Footer start -->
    <main>
    @include('user.layouts.footer')
    </main>
    <!-- Modern Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:18px; box-shadow:0 8px 32px rgba(0,0,0,0.18); overflow:hidden;">
                <div class="modal-header border-0"
                    style="background:linear-gradient(90deg,#e22323 0,#b81c1c 100%); color:#fff;">
                    <h4 class="modal-title w-100 text-center text-white" id="loginModalLabel"
                        style="font-weight:700; letter-spacing:1px;">
                        Sign In to Swaraj Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="outline:none; color:#fff; opacity:1;">
                        <span aria-hidden="true" style="font-size:2rem;">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 py-4" style="background:#fafbfc;">
                    <form>
                        <div class="form-group mb-3">
                            <label for="loginEmail" style="font-weight:500; color:#b81c1c;">Email
                                Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-envelope text-danger"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email"
                                    required style="border-left:0;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="loginPassword" style="font-weight:500; color:#b81c1c;">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-lock text-danger"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" id="loginPassword"
                                    placeholder="Enter your password" required style="border-left:0;">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe" style="font-size:15px;">Remember me</label>
                            </div>
                            <a href="#" style="color:#b81c1c; font-size:15px; font-weight:500;">Forgot
                                password?</a>
                        </div>
                        <button type="submit" class="btn btn-block"
                            style="background:linear-gradient(90deg,#e22323 0,#b81c1c 100%); color:#fff; font-weight:700; border-radius:8px; font-size:1.1rem; box-shadow:0 2px 8px rgba(184,28,28,0.08);">
                            Log In
                        </button>
                    </form>
                    <div class="text-center my-3" style="position:relative;">
                        <span
                            style="background:#fafbfc; padding:0 14px; position:relative; z-index:1; color:#b81c1c; font-weight:500;">OR</span>
                        <hr style="position:absolute; top:50%; left:0; width:100%; z-index:0; margin:0; border-color:#eee;">
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <button class="flex-fill mr-2 py-3"
                            style="border-radius:8px; border:1px solid #ddd; font-weight:600;">
                            <i class="fab fa-google mr-1" style="color:#e22323;"></i>
                        </button>
                        <button class="flex-fill mx-2 py-3"
                            style="border-radius:8px; border:1px solid #ddd; font-weight:600;">
                            <i class="fab fa-facebook-f mr-1" style="color:#1877f3;"></i>
                        </button>
                        <button class="flex-fill ml-2 py-3"
                            style="border-radius:8px; border:1px solid #ddd; font-weight:600;">
                            <i class="fab fa-x-twitter mr-1" style="color:#111;"></i>

                        </button>
                    </div>
                    <div class="text-center mb-2">
                        <span>Don't have an account?
                            <a href="#" style="color:#e22323; font-weight:600;" data-toggle="modal"
                                data-target="#signupModal" data-dismiss="modal">Sign up</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:18px; box-shadow:0 8px 32px rgba(0,0,0,0.18); overflow:hidden;">
                <div class="modal-header border-0"
                    style="background:linear-gradient(90deg,#e22323 0,#b81c1c 100%); color:#fff;">
                    <h4 class="modal-title w-100 text-center text-white" id="signupModalLabel"
                        style="font-weight:700; letter-spacing:1px;">
                        Create an account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="outline:none; color:#fff; opacity:1;">
                        <span aria-hidden="true" style="font-size:2rem;">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 py-4" style="background:#fafbfc;">
                    <form>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-user text-danger"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="signupName" placeholder="Full name" required
                                    style="border-left:0;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-envelope text-danger"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" id="signupEmail" placeholder="Your email" required
                                    style="border-left:0;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-phone text-danger"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="signupPhone" placeholder="Your phone" required
                                    style="border-left:0;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-lock text-danger"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" id="signupPassword" placeholder="Password"
                                    required style="border-left:0;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#fff; border-right:0;">
                                        <i class="fas fa-lock text-danger"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" id="signupRePassword"
                                    placeholder="Re-enter Password" required style="border-left:0;">
                            </div>
                        </div>
                        <div class="form-group mb-3 d-flex align-items-center">
                            <input type="checkbox" id="terms" required style="margin-right:8px;">
                            <label for="terms" class="mb-0" style="font-size:15px;">
                                I read and accept the <a href="#" style="color:#e22323;">terms of use.</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-block"
                            style="background:linear-gradient(90deg,#e22323 0,#b81c1c 100%); color:#fff; font-weight:700; border-radius:8px; font-size:1.1rem; box-shadow:0 2px 8px rgba(184,28,28,0.08);">
                            Sign up
                        </button>
                    </form>
                    <div class="text-center my-3" style="position:relative;">
                        <span
                            style="background:#fafbfc; padding:0 14px; position:relative; z-index:1; color:#b81c1c; font-weight:500;">OR</span>
                        <hr style="position:absolute; top:50%; left:0; width:100%; z-index:0; margin:0; border-color:#eee;">
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <button type="button" class="flex-fill mr-2 py-3"
                            style="border-radius:8px; border:1px solid #ddd; font-weight:600;">
                            <i class="fab fa-google mr-1" style="color:#e22323;"></i>
                        </button>
                        <button type="button" class="flex-fill mx-2 py-3"
                            style="border-radius:8px; border:1px solid #ddd; font-weight:600;">
                            <i class="fab fa-facebook-f mr-1" style="color:#1877f3;"></i>
                        </button>
                        <button type="button" class="flex-fill ml-2 py-3"
                            style="border-radius:8px; border:1px solid #ddd; font-weight:600;">
                            <i class="fab fa-x-twitter mr-1" style="color:#111;"></i>
                        </button>
                    </div>
                    <div class="text-center mb-2">
                        <span>Already have an account?
                            <a href="#" style="color:#e22323; font-weight:600;" data-toggle="modal"
                                data-target="#loginModal" data-dismiss="modal">Log in</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS here -->
<<!-- Core Libraries -->
<script src="{{ asset('user/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('user/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>

<!-- Modernizr (should come early for feature detection) -->
<script src="{{ asset('user/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>

<!-- Swiper JS (FIXED syntax) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- UI/UX & Effect Plugins -->
<script src="{{ asset('user/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('user/assets/js/ajax-form.js') }}"></script>
<script src="{{ asset('user/assets/js/paroller.js') }}"></script>
<script src="{{ asset('user/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('user/assets/js/js_isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('user/assets/js/imagesloaded.min.js') }}"></script>
<script src="{{ asset('user/assets/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('user/assets/js/parallax.min.js') }}"></script>
<script src="{{ asset('user/assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('user/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('user/assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('user/assets/js/parallax-scroll.js') }}"></script>
<script src="{{ asset('user/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('user/assets/js/element-in-view.js') }}"></script>

<!-- Navigation -->
<script src="{{ asset('user/assets/js/one-page-nav-min.js') }}"></script>

<!-- Custom Scripts (should be last to ensure dependencies load first) -->
<script src="{{ asset('user/assets/js/main.js') }}"></script>
<script src="{{ asset('user/assets/js/custom.js') }}"></script>
<script src="{{ asset('user/assets/js/lazyload.js') }}"></script>
<script src="{{ asset('user/admin/assets/js/ajax-form-submit.js') }}"></script>

<!-- External Libraries -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@19.1.3/dist/lazyload.min.js"></script>

<script src="{{ asset('user/js/global.js') }}?v=2"></script>

<!-- include app script -->
<!-- <script defer src="{{ asset('user/js/app.js') }}"></script> -->
@stack('js');
<script>
    var lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    });
</script>
<script>
    // Schema toggle via URL

    const getSchema = 'light'; // This should be dynamically set based on user preference or system setting
    // if (getSchema === "dark") {
    //     setDarkMode(1);
    // } else if (getSchema === "light") {
    //     setDarkMode(0);
    // }

    // Select all tabs
    const tabs = document.querySelectorAll('.nav-tabs li');

    // Add click event listener to each tab
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add active class to the clicked tab
            tab.classList.add('active');
        });
    });

    document.querySelectorAll('.dropdown-trigger').forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            document.querySelectorAll('.dropdown-content').forEach(drop => drop.style.display = 'none');
            const dropdown = document.getElementById(targetId);
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Optional: Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.uc-navbar-item')) {
            document.querySelectorAll('.dropdown-content').forEach(drop => drop.style.display = 'none');
        }
    });
</script>
</body>

</html>

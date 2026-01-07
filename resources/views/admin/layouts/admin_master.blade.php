<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Swaraj Post News">
		<meta name="author" content="Swaraj Post News">
		<meta name="keywords" content="swaraj post news admin dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/swaraj-fav-512x512.png')}}" />

		<!-- TITLE -->
		<title>Swaraj Post News</title>

		<!-- BOOTSTRAP CSS -->
		<link id="style" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/dist/flatpickr.min.css') }}">


		<!-- STYLE CSS -->
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @stack('css')

	</head>

	<body class="ltr app sidebar-mini light-mode">

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!-- app-Header -->
				@include('admin.layouts.header')
				<!-- /app-Header -->

				<!--APP-SIDEBAR-->
				@include('admin.layouts.navigation')
				<!--/APP-SIDEBAR-->

                <!--app-content open-->
                @yield('containt')

				<!-- CONTAINER CLOSED -->
			</div>

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
										<span class="country-selector"><img alt="unitedstates" src="{{asset('assets/images/flags/us_flag.jpg')}}" class="me-2 language"></span>United States
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="italy" src="{{asset('assets/images/flags/italy_flag.jpg')}}" class="me-2 language"></span>Italy
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="spain" src="{{asset('assets/images/flags/spain_flag.jpg')}}" class="me-2 language"></span>Spain
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="india" src="{{asset('assets/images/flags/india_flag.jpg')}}" class="me-2 language"></span>India
								</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="french" src="{{asset('assets/images/flags/french_flag.jpg')}}" class="me-2 language"></span>French
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="russia" src="{{asset('assets/images/flags/russia_flag.jpg')}}" class="me-2 language"></span>Russia
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="germany" src="{{asset('assets/images/flags/germany_flag.jpg')}}" class="me-2 language"></span>Germany
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="argentina" src="{{asset('assets/images/flags/argentina_flag.jpg')}}" class="me-2 language"></span>Argentina
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="uae" src="{{asset('assets/images/flags/uae_flag.jpg')}}" class="me-2 language"></span>UAE
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="austria" src="{{asset('assets/images/flags/austria_flag.jpg')}}" class="me-2 language"></span>Austria
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="mexico" src="{{asset('assets/images/flags/mexico_flag.jpg')}}" class="me-2 language"></span>Mexico
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="china" src="{{asset('assets/images/flags/china_flag.')}}" class="me-2 language"></span>China
								</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="poland" src="{{asset('assets/images/flags/poland_flag.jpg')}}" class="me-2 language"></span>Poland
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="canada" src="{{asset('assets/images/flags/canada_flag.jpg')}}" class="me-2 language"></span>Canada
									</a>
								</li>
								<li class="col-lg-4 mb-2">
									<a class="btn btn-country btn-lg btn-block">
										<span class="country-selector"><img alt="malaysia" src="{{asset('assets/images/flags/malaysia_flag.jpg')}}" class="me-2 language"></span>Malaysia
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /Country-selector modal-->
            @stack('modal')
            @stack('footer-containt')
			<!-- FOOTER -->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 text-center">
							 Copyright © 2025 <a href="javascript:void(0)">Swaraj Post</a>. Designed with <span class="fa fa-heart text-danger"></span> by <a href="https://givni.in/"> Givni It </a> All rights reserved
						</div>
					</div>
				</div>
			</footer>
			<!-- FOOTER CLOSED -->
		</div>

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

		<!-- JQUERY JS -->
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- SIDE-MENU JS -->
		<script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
		<script src="{{asset('assets/plugins/p-scroll/pscroll.js')}}"></script>

		<!-- FORMEDITOR JS -->
		<script src="{{asset('assets/plugins/quill/quill.min.js')}}"></script>

		<!--Internal Fancy uploader js-->
		<script src="{{asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
		<script src="{{asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
		<script src="{{asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
		<script src="{{asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
		<script src="{{asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

		<!-- SELECT2 JS -->
		<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>


		<!-- BLOG-EDIT JS-->
		<script src="{{asset('assets/js/blog-edit.js')}}"></script>

		<!-- STICKY JS -->
		<script src="{{asset('assets/js/sticky.js')}}"></script>

		<!-- COLOR THEME JS -->
		<script src="{{asset('assets/js/themeColors.js')}}"></script>

        <!-- fLAT PICKER THEME JS -->
        <script src="{{ asset('assets/plugins/flatpickr/dist/flatpickr.min.js') }}"></script>


		<!-- CUSTOM JS -->
		<script src="{{asset('assets/js/custom.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('assets/js/adminHelper/home.js')}}"></script>
        @stack('javascript')
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;

                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;

                    case 'success':
                        Swal.fire({
                            title: 'Success!',
                            text: "{{ Session::get('message') }}",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        break;

                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        });
    </script>


	</body>
</html>

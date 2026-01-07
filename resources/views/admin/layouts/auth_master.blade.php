<!doctype html>
<html lang="en" dir="ltr">
  <head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/swaraj-fav-512x512.png')}}" />

        <meta name="description" content="Swaraj Post News">
		<meta name="author" content="Swaraj Post News">
		<meta name="keywords" content="swaraj post news admin login">

		<!-- TITLE -->
		<title>Swaraj Post News</title>

		<!-- TITLE -->

		<!-- BOOTSTRAP CSS -->
		<link id="style" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"/>
        @stack('css')

	</head>


	<body class="ltr login-img">

			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
			</div>
			<!-- /GLOABAL LOADER -->

            @yield('containt')



		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

		<!-- STICKY JS -->
		<script src="{{asset('assets/js/sticky.js')}}"></script>

		<!-- COLOR THEME JS -->
		<script src="{{asset('assets/js/themeColors.js')}}"></script>

		<!-- CUSTOM JS -->
		<script src="{{asset('assets/js/custom.js')}}"></script>
        @stack('javascript')

	</body>
</html>

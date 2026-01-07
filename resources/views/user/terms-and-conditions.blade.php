@extends('user.layouts.main')


@section('containt')

<div id="wrapper" class="wrap overflow-hidden-x">
    <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
        <div class="container max-w-xl">
            <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                <li><a href="index.html">Home</a></li>
                <li><i class="unicon-chevron-right opacity-50"></i></li>
                <li><span class="opacity-50">Terms and Conditions</span></li>
            </ul>
        </div>
    </div>

    <div class="section py-4 lg:py-6 xl:py-8">
        <div class="container max-w-lg">
            <div class="page-wrap panel vstack gap-4 lg:gap-6 xl:gap-8">
                <header class="page-header panel vstack justify-center gap-2 lg:gap-4 text-center">
                    <div class="panel">
                        <h1 class="h3 lg:h1 m-0">Terms and Conditions</h1>
                    </div>
                </header>
                <div class="page-content panel fs-6 md:fs-5">
                    <p>Welcome to <strong>Swaraj Post News</strong>. By accessing and using our website, you agree to be bound by these Terms and Conditions. If you do not agree, please do not use our website.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Use of the Website</h3>
                    <ul class="list list-bullets">
                        <li>The content provided is for informational purposes only and should not be considered professional advice.</li>
                        <li>You agree not to use the website for any unlawful purpose.</li>
                        <li>We reserve the right to modify or discontinue any part of the website without notice.</li>
                    </ul>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Intellectual Property Rights</h3>
                    <p>All content on this website, including text, images, and logos, is owned by <strong>Swaraj Post News</strong> and protected under copyright laws.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">User-Generated Content</h3>
                    <ul class="list list-bullets">
                        <li>Users may submit comments and feedback, but we reserve the right to remove any content that is offensive or inappropriate.</li>
                        <li>You grant us a non-exclusive license to use any content you submit to the website.</li>
                    </ul>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Privacy Policy</h3>
                    <p>Your use of this website is also governed by our <a href="[Privacy Policy URL]">Privacy Policy</a>.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Third-Party Links</h3>
                    <p>Our website may contain links to third-party websites. We are not responsible for their content or privacy policies.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Disclaimer of Liability</h3>
                    <p>We are not responsible for any damages or losses resulting from your use of this website.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Changes to Terms</h3>
                    <p>We reserve the right to update these Terms and Conditions at any time. Continued use of the website signifies your acceptance of any changes.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Governing Law</h3>
                    <p>These Terms and Conditions are governed by the laws of <strong>[Your Country/State]</strong>.</p>
                </div>
                <div class="page-footer panel">
                    <p class="fs-7 opacity-60 m-0">Last updated: [Insert Date]</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

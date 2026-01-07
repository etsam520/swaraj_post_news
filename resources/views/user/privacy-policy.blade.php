@extends('user.layouts.main')


@section('containt')

<div id="wrapper" class="wrap overflow-hidden-x">
    <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
        <div class="container max-w-xl">
            <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                <li><a href="index.html">Home</a></li>
                <li><i class="unicon-chevron-right opacity-50"></i></li>
                <li><span class="opacity-50">Privacy Policy</span></li>
            </ul>
        </div>
    </div>

    <div class="section py-4 lg:py-6 xl:py-8">
        <div class="container max-w-lg">
            <div class="page-wrap panel vstack gap-4 lg:gap-6 xl:gap-8">
                <header class="page-header panel vstack justify-center gap-2 lg:gap-4 text-center">
                    <div class="panel">
                        <h1 class="h3 lg:h1 m-0">Privacy Policy</h1>
                    </div>
                </header>
                <div class="page-content panel fs-6 md:fs-5">
                    <p>At <strong>Swaraj Post News</strong>, we value your privacy and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Information We Collect</h3>
                    <ul class="list list-bullets">
                        <li>Personal details (such as name, email) provided by users.</li>
                        <li>Browsing data, including IP address and cookies.</li>
                        <li>User interactions, such as comments and feedback.</li>
                    </ul>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">How We Use Your Information</h3>
                    <ul class="list list-bullets">
                        <li>To improve website functionality and user experience.</li>
                        <li>To send newsletters or updates if you opt-in.</li>
                        <li>To monitor and prevent fraudulent activities.</li>
                    </ul>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Sharing of Information</h3>
                    <p>We do not sell or rent personal data. However, we may share information with third parties for analytics, legal compliance, or service enhancements.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Cookies</h3>
                    <p>Our website uses cookies to enhance user experience. You can manage cookie preferences through your browser settings.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Third-Party Links</h3>
                    <p>Our website may contain links to external sites. We are not responsible for their privacy policies or content.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Data Security</h3>
                    <p>We take appropriate measures to protect user data from unauthorized access, alteration, or disclosure.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Your Rights</h3>
                    <p>You have the right to access, correct, or request deletion of your personal data by contacting us.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Changes to This Policy</h3>
                    <p>We reserve the right to update this Privacy Policy at any time. Continued use of our website signifies acceptance of the changes.</p>
                </div>
                <div class="page-footer panel">
                    <p class="fs-7 opacity-60 m-0">Last updated: [Insert Date]</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

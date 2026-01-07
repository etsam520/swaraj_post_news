<header class="header-area" id="header-sticky">
        <marquee class="marquee" behavior="scroll" direction="left"
            style="color:#fff; font-weight: 600; background: #b81c1c; padding: 6px 0;z-index: 9;position: relative;">
            <span>
               <i class="fas fa-square" style="margin-right:8px; font-size: 10px !important;"></i>
            Notice: Welcome to Swaraj Post News! Stay tuned for the latest updates and announcements.
            </span>  
        </marquee>
        <div class="header-top second-header">
            <div class="container">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-2 col-md-2 d-none d-lg-block">
                    </div>
                    <div class="col-lg-6 col-md-8 d-none  d-md-block">
                        <div class="header-cta">
                            <div class="multilevel-dropdown position-relative"
                                style="display: flex; align-items: center; justify-content: flex-end; gap: 16px;">
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="stateDropdown" did="state-dropdown"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="min-width: 180px; font-weight: 500;">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        Select State
                                    </button>
                                    <div class="dropdown-menu shadow" aria-labelledby="stateDropdown" id="stateDropdownMenu"
                                        style="min-width: 200px;">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                            href="#" data-state="Maharashtra">
                                            Maharashtra <i class="fas fa-chevron-right text-muted"></i>
                                        </a>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                            href="#" data-state="Uttar Pradesh">
                                            Uttar Pradesh <i class="fas fa-chevron-right text-muted"></i>
                                        </a>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                            href="#" data-state="Bihar">
                                            Bihar <i class="fas fa-chevron-right text-muted"></i>
                                        </a>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                            href="#" data-state="West Bengal">
                                            West Bengal <i class="fas fa-chevron-right text-muted"></i>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu shadow sub-menu" id="districtMenu"
                                        style="display:none; position:absolute; left:210px; top:75px; min-width:200px;">
                                    </div>
                                </div>
                                <span
                                    style="display:inline-block; width:1px; height:28px; background:#ccc; margin:0 18px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 d-none d-lg-block">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div class="header-social" style="display: flex; gap: 12px;">
                                <a href="https://www.facebook.com/profile.php?id=61572985749885&mibextid=ZbWKwL" target="_blank" title="Facebook"><i
                                        class="fab fa-facebook"></i></a>
                                <a href="https://x.com/SwarajPost" target="_blank" title="Twitter"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com/swaraj_post_patna?igsh=MXVmYmJ4djd5NW5wYw==" target="_blank" title="Instagram"><i
                                        class="fab fa-instagram"></i></a>
                                <a href="https://youtube.com/@swarajpost?si=pPNU066bQH9HYzwC" target="_blank" title="Youtube"><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                            <span
                                style="display:inline-block; width:1px; height:28px; background:#ccc; margin:0 18px;"></span>
                            <div class="header-account">
                                <a href="#" title="My Account" style="color:#333; font-size:30px;" data-toggle="modal"
                                    data-target="#loginModal">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="" class="menu-area">
            <div class="container-fluid">
                <div class="second-menu">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{url('/')}}"><img src="{{asset('assets/images/brand/swaraj-post-logo.png')}}" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="main-menu text-right">
                                <nav id="mobile-menu" >
                                    <ul>
                                        <li><a href="index">Home</a></li>
                                        <li><a href="about">About Us</a></li>
                                        <li><a href="products">Products</a></li>
                                        <li><a href="gallery">Gallery</a></li>
                                        <li><a href="certificate">Certificate</a></li>
                                        <li><a href="contact">Contact</a></li>
                                        <div class="d-block d-lg-none" style="margin:30px 0px;text-align:center;">
                                            <a href="#"
                                                style="margin-right:10px; padding: 6px 18px; border-radius: 4px; background: orange; color: #fff; border: none; text-decoration: none;"
                                                data-toggle="modal" data-target="#loginModal">Sign In</a>
                                            <a href="#"
                                                style="padding: 6px 18px; border-radius: 4px; background: #fff; color: #333; border: none; text-decoration: none;"
                                                data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Sign
                                                Up</a>
                                        </div>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="bg-transparent border-0 text-white" type="button" data-toggle="offcanvas"
                                data-target="#rightOffcanvas" aria-controls="rightOffcanvas"
                                style="position:fixed;top:50px;right:18px;z-index:1051;">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="rightOffcanvas"
                                aria-labelledby="rightOffcanvasLabel"
                                style="width: 280px; background: #fff; box-shadow: -2px 0 16px rgba(0,0,0,0.08);">
                                <div class="offcanvas-header px-3 py-4" style="border-bottom:1px solid #eee;">
                                    <img src="assets/img/logo/logo.png" alt="" style="height:40px;">
                                    <button type="button" class="close text-danger" data-dismiss="offcanvas"
                                        aria-label="Close" style="font-size:2rem;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="offcanvas-body px-3 py-4" id="sidebar-category">
                                    <ul class="list-unstyled mb-4">
                                        <li><a href="index" class="d-block py-2 px-2 text-dark">Home</a></li>
                                        <li><a href="about" class="d-block py-2 px-2 text-dark">About Us</a></li>
                                        <li><a href="products" class="d-block py-2 px-2 text-dark">Products</a></li>
                                        <li><a href="gallery" class="d-block sidebar-categorypy-2 px-2 text-dark">Gallery</a></li>
                                        <li><a href="certificate" class="d-block py-2 px-2 text-dark">Certificate</a>
                                        </li>
                                        <li><a href="contact" class="d-block py-2 px-2 text-dark">Contact</a></li>
                                    </ul>
                                    <div class="mb-3">
                                        <a href="#" class="btn btn-danger btn-block mb-2" data-toggle="modal"
                                            data-target="#loginModal">Sign In</a>
                                        <a href="#" class="btn btn-outline-danger btn-block" data-toggle="modal"
                                            data-target="#signupModal" data-dismiss="modal">Sign Up</a>
                                    </div>
                                    <div class="d-flex justify-content-center" style="gap:12px;">
                                         <a href="https://www.facebook.com/profile.php?id=61572985749885&mibextid=ZbWKwL" target="_blank" title="Facebook"><i
                                                class="fab fa-facebook"></i></a>
                                        <a href="https://x.com/SwarajPost" target="_blank" title="Twitter"><i
                                                class="fab fa-twitter"></i></a>
                                        <a href="https://www.instagram.com/swaraj_post_patna?igsh=MXVmYmJ4djd5NW5wYw==" target="_blank" title="Instagram"><i
                                                class="fab fa-instagram"></i></a>
                                        <a href="https://youtube.com/@swarajpost?si=pPNU066bQH9HYzwC" target="_blank" title="Youtube"><i
                                                class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

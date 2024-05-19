@php
    $settingData = App\Models\CsThemeAdmin::where('id', 1)->first();
    $userid = Session::get('CS_ADMIN');

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin - @if (isset($title) && $title != '')
            {{ $title }}
        @endif
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ env('SETTING_IMAGE') }}{{ $settingData->favicon }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"
        integrity="sha512-MqL4+Io386IOPMKKyplKII0pVW5e+kb+PI/I3N87G3fHIfrgNNsRpzIXEi+0MQC0sR9xZNqZqCYVcC61fL5+Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/backend_assets/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('public/backend_assets/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/backend_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('public/backend_assets/assets/css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">



        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                {{-- <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                </a> --}}
                {{-- <img src="{{env('DEFAULT_IMAGE')}}" alt=""> --}}
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ env('SETTING_IMAGE') }}{{ $settingData->logo }}"
                            alt="" style="width: 50px; height: 50px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Paradise</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('csadmin.dashboard.index') }}"
                        class="nav-item nav-link @php echo (isset($title) && $title == 'Dashboard' )?'active':'' @endphp"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle @php echo (isset($title) && $title == 'Product' ||$title == 'Add Product'||$title == 'Category')?'active':'' @endphp"
                            data-bs-toggle="dropdown"><i class="ri-shopping-cart-line me-2"></i>Product</a>
                        <div
                            class="dropdown-menu bg-transparent border-0 @php echo (isset($title) && $title == 'Product' ||$title == 'Add Product'||$title == 'Category')?'show':'' @endphp">
                            <a href="{{ route('csadmin.product.index') }}" class="dropdown-item @php echo (isset($title) && $title == 'Product')?'active':'' @endphp">Product</a>
                            <a href="{{ route('csadmin.product.addproduct') }}" class="dropdown-item @php echo (isset($title) && $title == 'Add Product')?'active':'' @endphp">Add Product</a>
                            <a href="{{ route('csadmin.product.category') }}" class="dropdown-item @php echo (isset($title) && $title == 'Category')?'active':'' @endphp">Category</a>

                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle @php echo (isset($title) && $title == 'Menu' ||$title == 'Footer' ||$title == 'Slider & Banner' ||$title == 'Add Slider & Banner')?'active':'' @endphp"
                            data-bs-toggle="dropdown"><i class="ri-dashboard-line me-2"></i>Appearence</a>
                        <div
                            class="dropdown-menu bg-transparent border-0 @php echo (isset($title) && $title == 'Menu' ||$title == 'Footer' ||$title == 'Slider & Banner' ||$title == 'Add Slider & Banner')?'show':'' @endphp">
                            <a href="{{ route('csadmin.appearence.menu') }}"
                                class="dropdown-item @php echo (isset($title) && $title == 'Menu')?'active':'' @endphp">Menu</a>
                                <a href="{{ route('csadmin.appearence.slider') }}"
                                class="dropdown-item @php echo (isset($title) && $title == 'Slider & Banner'||$title == 'Add Slider & Banner')?'active':'' @endphp">Slider & Banner</a>
                            <a href="{{ route('csadmin.appearance.footer') }}"
                                class="dropdown-item @php echo (isset($title) && $title == 'Footer')?'active':'' @endphp">Footer</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('csadmin.media') }}"
                        class="nav-item nav-link @php echo (isset($title) && $title == 'Media'||$title == "Add Media")?'active':'' @endphp"><i
                            class="ri-image-2-line me-2" ></i>Media</a>
                            
                            <a href="{{ route('csadmin.ourteam.ourteam') }}"
                        class="nav-item nav-link @php echo (isset($title) && $title == 'Our Team'||$title == "Add Team")?'active':'' @endphp"><i
                            class="ri-team-line me-2" ></i>Our Team</a>
                            
                    <a href="{{ route('csadmin.faq.faq') }}"
                        class="nav-item nav-link @php echo (isset($title) && $title == 'FAQ'||$title == "Add FAQ")?'active':'' @endphp"><i
                            class="ri-question-answer-line me-2"></i>FAQ</a>
                    <a href="{{ route('csadmin.newsletter.newsletter') }}"
                        class="nav-item nav-link @php echo (isset($title) && $title == 'NewsLetter')?'active':'' @endphp"><i
                            class="ri-news-line me-2"></i>NewsLetter</a>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle @php echo (isset($title) && $title == 'Contact' )?'active':'' @endphp"
                            data-bs-toggle="dropdown"><i class="ri-dashboard-line me-2"></i>Enquiry</a>
                        <div
                            class="dropdown-menu bg-transparent border-0 @php echo (isset($title) && $title == 'Contact')?'show':'' @endphp">
                            <a href="{{ route('csadmin.enquiry.contact') }}"
                                class="dropdown-item @php echo (isset($title) && $title == 'Contact')?'active':'' @endphp">Contact Enquiry</a>
                                
                            
                        </div>
                    </div>

<a href="{{ route('csadmin.page.page') }}"
                        class="nav-item nav-link @php echo (isset($title) && $title == 'Page'||$title == "Add Page")?'active':'' @endphp"><i
                            class="ri-pages-line me-2"></i>Pages</a>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle @php echo (isset($title) && $title == 'Site Setting' || $title == 'Social Settings' )?'active':'' @endphp"
                            data-bs-toggle="dropdown"><i class="ri-settings-line me-2"></i>Settings</a>
                        <div
                            class="dropdown-menu bg-transparent border-0 @php echo (isset($title) && $title == 'Site Setting' || $title == 'Social Settings')?'show':'' @endphp">
                            <a href="{{ route('csadmin.settings.sitesetting') }}"
                                class="dropdown-item @php echo (isset($title) && $title == 'Site Setting')?'active':'' @endphp">Site
                                Setting</a>
                            <a href="{{ route('csadmin.settings.socialsetting') }}"
                                class="dropdown-item @php echo (isset($title) && $title == 'Social Settings')?'active':'' @endphp">Social
                                Setting</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><img class="rounded-circle"
                            src="{{ env('SETTING_IMAGE') }}{{ $settingData->logo }}" alt=""
                            style="width: 40px; height: 40px;"></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle"
                                        src="{{ asset('public/backend_assets/assets/img/user.jpg') }}" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle"
                                        src="{{ asset('public/backend_assets/assets/img/user.jpg') }}" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle"
                                        src="{{ asset('public/backend_assets/assets/img/user.jpg') }}" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2"
                                src="{{ env('SETTING_IMAGE') }}{{ $settingData->logo }}" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Paradise</span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <p class="text-center">Welcome Paradise</p>
                            <a href="{{ route('csadmin.adminLogout') }}" onclick="return confirm('You Want to Logout?')" class="dropdown-item"><i
                                    class="ri-logout-box-r-line me-2"></i>Log Out</a>
                        </div>
                    </div>

                </div>
            </nav>
            <!-- Navbar End -->
            @yield('content')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/full-all/ckeditor.js"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('.ckeditor');
        CKEDITOR.addCss('.cke_editable { background-color: black; color: white }');

        CKEDITOR.config.allowedContent = true;
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('public/backend_assets/assets/js/main.js') }}"></script>



</body>

</html>

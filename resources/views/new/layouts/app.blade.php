<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Acuas - Drinking Water Website Template')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('acuas/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('acuas/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('acuas/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('acuas/css/style.css') }}" rel="stylesheet">

    @stack('styles')
    @stack('head')
</head>
<body>
<!-- Spinner Start -->
{{--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">--}}
{{--    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">--}}
{{--        <span class="sr-only">Loading...</span>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Spinner End -->

<!-- Navbar & Hero wrapper (hero/carousel goes inside -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ url('/') }}" class="navbar-brand p-3">
            <h1 class="text-primary"><img width="100" height="350" src="{{ asset('acuas/img/logo.png') }}" alt="Logo">IDEALMETER</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home',app()->getLocale()) }}"
                   class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about',app()->getLocale()) }}" class="nav-item nav-link">About</a>
                <a href="{{ route('service',app()->getLocale()) }}" class="nav-item nav-link">Service</a>
                <a href="{{ route('blog',app()->getLocale()) }}" class="nav-item nav-link">Blog</a>
                <a href="{{ route('contact',app()->getLocale()) }}"
                   class="nav-item nav-link">{{__('messages.contact')}}</a>
            </div>
            <div class="d-none d-xl-flex me-5">
                <div class="d-flex flex-column pe-3 border-end border-primary">
                    <button class="btn btn-primary rounded-pill flex-shrink-0 py-2 px-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal">{{__('messages.search')}}<i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="d-none d-xl-flex me-5">
                <div class="d-flex flex-column">

                    @auth
                        <span class="btn btn-outline-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">
                {{ auth()->user()->name }}
            </span>
                    @endauth

                    @guest
                        <a href="{{ route('login', app()->getLocale()) }}"
                           class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">
                            {{ __('messages.login') }}
                        </a>
                    @endguest

                </div>
            </div>

        </div>
    </nav>

    {{-- Page-specific hero/headers will render here as part of @yield("content") --}}
    @yield('content')
</div>

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="exampleModalLabel">Search by keyword</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords"
                           aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text btn border p-3"><i
                            class="fa fa-search text-white"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5 mb-5 align-items-center">
            <div class="col-lg-7">
                <div class="position-relative mx-auto">
                    <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                           placeholder="Email address to Subscribe">
                    <button type="button"
                            class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">
                        Subscribe
                    </button>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                    <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                            class="fab fa-instagram"></i></a>
                    <a class="btn btn-secondary btn-md-square rounded-circle me-0" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <div class="footer-item">
                        <h3 class="text-white mb-4"><i class="fas fa-hand-holding-water text-primary me-3"></i>Acuas
                        </h3>
                        <p class="mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
                    </div>
                    <div class="position-relative">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                               placeholder="Enter your email">
                        <button type="button"
                                class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">
                            SignUp
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">About Us</h4>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Why Choose Us</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Free Water Bottles</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Water Dispensers</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Bottled Water Coolers</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Business Hours</h4>
                    <div class="mb-3">
                        <h6 class="text-muted mb-0">Mon - Friday:</h6>
                        <p class="text-white mb-0">09.00 am to 07.00 pm</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-0">Saturday:</h6>
                        <p class="text-white mb-0">10.00 am to 05.00 pm</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-0">Vacation:</h6>
                        <p class="text-white mb-0">All Sunday is our vacation</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Contact Info</h4>
                    <a href="#"><i class="fa fa-map-marker-alt me-2"></i> 123 Street, New York, USA</a>
                    <a href="mailto:info@example.com"><i class="fas fa-envelope me-2"></i> info@example.com</a>
                    <a href="mailto:info@example.com"><i class="fas fa-envelope me-2"></i> info@example.com</a>
                    <a href="tel:{{$siteSetting->value['support_phone']}}"><i
                            class="fas fa-phone me-2"></i> {{$siteSetting->value['support_phone']}}</a>
                    <a href="tel:{{$siteSetting->value['support_phone']}}" class="mb-3"><i
                            class="fas fa-print me-2"></i> {{$siteSetting->value['support_phone']}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-body"><a href="#" class="border-bottom text-white"><i
                            class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end text-body">
                Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed
                By <a class="border-bottom text-white" href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/acuas/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('/acuas/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('/acuas/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('/acuas/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('/acuas/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
</body>
</html>

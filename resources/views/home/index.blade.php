<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Futami Produksi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    {{-- <link href="assets/vendor/aos/aos.css" rel="stylesheet"> --}}
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    {{-- <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> --}}

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: BizLand - v3.10.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center" style="background-color: #98c1d9">
        <div class="container d-flex align-items-center justify-content-between">

            {{-- <h1 class="logo"><a href="index.html">Futami</a></h1> --}}
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="/" class="logo"><img src="assets/img/futamilogo.png" class="img-fluid" alt=""></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    @if (Auth::user())
                        <li><a class="nav-link scrollto" href="/dashboard">Dashboard</a></li>
                        <li><a class="nav-link scrollto" href="/logout">Logout</a></li>
                    @else
                        <li><a class="nav-link scrollto" href="/login">Login</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center justify-content-center" style="background-color: ">
        <div class="row mx-4">
            <div class="col-md-6 col-sm-12 align-self-center">
                <h1>Welcome to</h1>
                <h1><span>Production Futami Apps</span></h1>
            </div>
            <div class="col-md-6 col-sm-12 align-self-center">
                <img src="assets/img/produksi.png" class="img-fluid" alt="">
            </div>

        </div>
        </div>
    </section><!-- End Hero -->
    <!-- End #main -->
    {{-- <div id="preloader"></div> --}}
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src={{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}></script>
    {{-- <script src={{asset('assets/vendor/aos/aos.js')}}></script> --}}
    <script src={{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}></script>
    <script src={{asset('assets/vendor/glightbox/js/glightbox.min.js')}}></script>
    <script src={{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}></script>
    <script src={{asset('assets/vendor/swiper/swiper-bundle.min.js')}}></script>
    <script src={{asset('assets/vendor/waypoints/noframework.waypoints.js')}}></script>
    <script src={{asset('assets/vendor/php-email-form/validate.js')}}></script>

    <!-- Template Main JS File -->
    <script src={{asset('js/main.js')}}></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futami - Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<body id="page-top" style="background-color: #e0fbfc">
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion {{ request()->is('dashboard/profile') || request()->is('dashboard/profile/password-verify') || request()->is('dashboard/edit-password') ? 'd-none' : 'd-md-inline-block' }}"
            id="sidebar" style="display:none">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="/">
                <img src="{{ asset('assets/img/futamilogo.png') }}" class="img-fluid" alt="">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-3">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>


            <!-- Nav Item - Pages Collapse Menu -->
            @if (Auth::user()->role_id == 3)
                <li class="nav-item {{ request()->is('dashboard/user-data') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/user-data">
                        <i class="fa-solid fa-users"></i>
                        <span>User Data</span>
                    </a>
                </li>
            @endif

            <div class="sidebar-heading">
                Varian
            </div>

            {{-- <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Varian</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="/dashboard/produksi">Varian</a>
                        <a class="collapse-item" href="/dashboard/jenis-botol">Jenis Botol</a>
                        <a class="collapse-item" href="/dashboard/jenis-karton">Jenis Karton</a>
                        <a class="collapse-item" href="/dashboard/jenis-label">Jenis Label</a>
                        <a class="collapse-item" href="/dashboard/jenis-label">Jenis Cap</a>
                    </div>
                </div>
            </li> --}}

            @if (request()->is('dashboard/produksi/*/batch-list') ||
                    request()->is('dashboard/reject-produksi/*/botol/*') ||
                    request()->is('dashboard/sampel-produksi/*/botol/*') ||
                    request()->is('dashboard/*/botol/*/trial') ||
                    request()->is('dashboard/*/cap/*/trial') ||
                    request()->is('dashboard/*/batch') ||
                    request()->is('dashboard/*/loss-liquid'))
                <li class="nav-item {{ request()->is('dashboard/produksi') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/produksi">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Produksi - Trial</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/varian') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/varian">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Varian</span>
                    </a>
                </li>
            @else
                <li class="nav-item {{ request()->is('dashboard/jenis-botol') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/jenis-botol">
                        <i class="fa-solid fa-bottle-water"></i>
                        <span>Jenis Botol</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/jenis-cap') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/jenis-cap">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Jenis Cap</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/jenis-label') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/jenis-label">
                        <i class="fa-solid fa-tag"></i>
                        <span>Jenis Label</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/jenis-karton') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/jenis-karton">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>Jenis Karton</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/jenis-lakban') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/jenis-lakban">
                        <i class="fa-solid fa-tape"></i>
                        <span>Jenis Lakban</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/varian') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/varian">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Varian</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/produksi') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/produksi">
                        <i class="fa-brands fa-product-hunt"></i>
                        <span>Produksi - Trial</span>
                    </a>
                </li>

                <hr class="sidebar-divider my-0">

                <div class="sidebar-heading">
                    Reject
                </div>

                <li class="nav-item {{ request()->is('dashboard/density') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/density">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Jenis Density</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/spesifik-tempat') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/spesifik-tempat">
                        <i class="fa-solid fa-location-pin"></i>
                        <span>Spesifik Tempat</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/tempat') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/tempat">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Tempat</span>
                    </a>
                </li>

                <hr class="sidebar-divider my-0">

                <div class="sidebar-heading">
                    Parameter
                </div>

                <li class="nav-item {{ request()->is('dashboard/parameter-reject') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/parameter-reject">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Parameter Reject</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/parameter-sampel') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/parameter-sampel">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Parameter Sampel</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/parameter-varian') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/parameter-varian">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>Parameter Varian</span>
                    </a>
                </li>
            @endif



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: #ECF2FF">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow-sm" style="background-color:#fff">


                    <a href="{{ url()->previous() }}" class="btn text-dark">
                        <i class="fa-solid fa-arrow-left fa-2x"></i>
                    </a>


                    <label for="pilih"><i
                            class="fas fa-bars fa-2x mx-3 {{ request()->is('dashboard/profile') || request()->is('dashboard/profile/password-verify') || request()->is('dashboard/edit-password') ? 'd-none' : 'd-md-none' }}"></i></label>
                    <input class="fa fa-bars fa-2x" style="display: none" type="checkbox" checked role=""
                        id="pilih" onchange="sidebar()">

                    <!-- Topbar Search -->
                    @if (request()->is('dashboard/material-data'))
                        <form action="{{ route('dashboard.index') }}" method="get" id="search"
                            class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            @csrf

                            <div class="input-group">
                                <input autofocus type="text" class="form-control bg-light border-0 small"
                                    name="search" placeholder="Cari No Material/Stok..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                <a class="btn btn-danger d-none d-md-inline" href="/dashboard/material-data">RESET</a>
                            </div>
                        </form>
                    @elseif(request()->is('dashboard/user-data'))
                        <form action="{{ route('user-index') }}" method="GET" id="search"
                            class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" name="search"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn text-white" style="background-color: #98c1d9" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                <a class="btn btn-danger" href="/dashboard/user-data"><i
                                        class="fa-solid fa-arrow-rotate-right"></i></a>
                            </div>
                        </form>
                    @elseif(request()->is('dashboard/stok-langsung'))
                        <form class="form-inline mr-auto ms-3" method="GET" id="search"
                            action="{{ route('dashboard-langsung') }}">
                            <div class="search-element d-flex">
                                <div class="">
                                    <input class="form-control" type="date" name="tanggal_awal"
                                        aria-label="Search" data-width="250">
                                    <input class="form-control" type="date" name="tanggal_selesai"
                                        aria-label="Search" data-width="250">
                                </div>
                                <button class="btn text-white" style="background-color: #98c1d9" type="submit"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </form>
                    @elseif(request()->is('dashboard/produksi'))
                        <form class="form-inline mr-auto ms-3" method="GET" id="search"
                            action="{{ route('produksi-index') }}">
                            <div class="search-element d-flex">
                                <div class="">
                                    <input class="form-control" type="date" name="tanggal_awal"
                                        aria-label="Search">
                                    <input class="form-control" type="date" name="tanggal_selesai"
                                        aria-label="Search">
                                </div>
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    @endif


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto mr-3">
                        @if (Auth::user())
                            <li>
                                <div class="dropdown mx-4 ms-5 ms-md-3">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false" aria-expanded="false"><i
                                            class="fa-solid fa-user me-2"></i><span
                                            class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    </button>
                                    <ul class="dropdown-menu bg-primary text-primary-emphasis">
                                        <li><span
                                                class="dropdown-item d-md-none text-white">{{ Auth::user()->name }}</span>
                                        </li>
                                        <li><a class="dropdown-item text-white" href="/dashboard/profile"><i
                                                    class="fa-solid fa-user me-2"></i><span>Profile</span>
                                            </a></li>
                                        <li><a class="dropdown-item text-white" href="/"><i
                                                    class="fa-solid fa-house me-2"></i><span>Home</span> </a></li>
                                        <li><a class="dropdown-item text-white" href="/logout"><i
                                                    class="fa-solid fa-right-to-bracket me-2"></i><span>Logout</span>
                                            </a></li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div id="main" class="mx-2 mx-md-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}

    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        function sidebar() {
            let pilih = document.getElementById("pilih")
            if (pilih.checked) {
                document.getElementById("sidebar").style.display = "none";
                document.getElementById("search").style.display = "";
            } else {
                document.getElementById("sidebar").style.display = "";
                document.getElementById("search").style.display = "none";


            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Parameter',
                allowClear: true
            })
        });
    </script>





</body>

@extends('layout.layout-auth')

@section('content')
    <section class="vh-100" style="background-color: #98c1d9;">
        @if (session('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px; background-color:#e0fbfc">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                                    <form class="mx-1 mx-md-4" action="/login" method="POST">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                                                    <input placeholder="Alias" type="text" name="alias" id="form3Example3c"
                                                    class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"> <i class="fas fa-lock fa-lg"></i></span>
                                                    <input placeholder="Password" type="password" name="password"
                                                    id="form3Example4c" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn text-white btn-lg" style="background-color:#98c1d9">Login</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center justify-content-center order-1 order-lg-2">
                                    <img src="{{ asset('assets/img/login.png') }}" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

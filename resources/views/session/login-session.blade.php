@extends('layouts.user_type.guest')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <main class="main-content  mt-0">
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="{{ asset('images/icons/icon-logo.svg') }}" class="mb-3"
                                                alt="logo"
                                                style="width:
                                                185px;"
                                                alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">Punto de venta</h4>
                                        </div>

                                        <form role="form" method="POST" action="/session">
                                            @csrf
                                            <label>Email</label>
                                            <div class="mb-3">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email" value="admin@softui.com" aria-label="Email"
                                                    aria-describedby="email-addon">
                                                @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <label>Password</label>
                                            <div class="mb-3">
                                                <input type="password" class="form-control" name="password" id="password"
                                                    placeholder="Password" value="secret" aria-label="Password"
                                                    aria-describedby="password-addon">
                                                @error('password')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="rememberMe"
                                                    checked="">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                            <div class="text-center">
                                                {{-- <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                                                    Sign in</button> --}}
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                    type="submit">Login</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">Universidad Politécnica de Victoria</h4>
                                        <p class="small mb-0">Proyecto final para la materia de tecnologías y aplicaciones
                                            web</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


{{-- @section('xd')
    <form role="form" method="POST" action="/session">
        @csrf
        <label>Email</label>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                value="admin@softui.com" aria-label="Email" aria-describedby="email-addon">
            @error('email')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <label>Password</label>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="secret"
                aria-label="Password" aria-describedby="password-addon">
            @error('password')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
            <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <div class="text-center">
            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                in</button>
        </div>
    </form>
@endsection

@section('xd2')
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                <p class="mb-0">Create a new acount<br></p>
                                <p class="mb-0">OR Sign in with these credentials:</p>
                                <p class="mb-0">Email <b>admin@softui.com</b></p>
                                <p class="mb-0">Password <b>secret</b></p>
                                <p class="mb-0">Alumno: <b>JOSE ANDRIK MARTINEZ RODRIGUEZ</b></p>
                                <p class="mb-0">Alumno: <b>CHRISTOPHER EMMANUEL PEREZ DUQUE</b></p>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="/session">
                                    @csrf
                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" value="admin@softui.com" aria-label="Email"
                                            aria-describedby="email-addon">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Password" value="secret" aria-label="Password"
                                            aria-describedby="password-addon">
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <small class="text-muted">Forgot you password? Reset you password
                                    <a href="/login/forgot-password"
                                        class="text-info text-gradient font-weight-bold">here</a>
                                </small>
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}

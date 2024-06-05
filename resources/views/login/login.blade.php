@extends('login.layout.main')

@section('title', 'Login')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0 ">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image"
                                    style="background-image: url('https://images.unsplash.com/photo-1576176539998-0237d1ac6a85?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('img/yukkemah.png') }}" alt="" class="img-fluid col-6">
                                        <h3 class="text-dark mt-5 mb-4 fw-bold">Selamat Datang Kembali!</h3>
                                    </div>
                                    <form class="user" method="POST" action="/login">
                                        @csrf
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="text"
                                                placeholder="Username" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password"
                                                placeholder="Password" name="password">
                                        </div>
                                        @if (session()->has('loginError'))
                                            <div class="ms-3">
                                                <small class="text-danger">Username atau password salah.</small>
                                            </div>
                                        @endif
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="/register">Belum punya akun? Yuk!
                                            Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

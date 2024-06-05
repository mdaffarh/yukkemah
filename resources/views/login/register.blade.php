@extends('login.layout.main')

@section('title', 'Daftar')

@section('container')
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"
                            style="background-image: url('https://images.unsplash.com/photo-1537905569824-f89f14cceb68?q=80&w=2004&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="{{ asset('img/yukkemah.png') }}" alt="" class="img-fluid col-6 col-md-4 col-lg-2">
                                <h4 class="mt-5 text-dark mb-4 fw-bold">Daftar Sekarang!</h4>
                            </div>
                            <form class="user" method="POST" action="/register">
                                @csrf
                                <div class="mb-3"><input
                                        class="form-control form-control-user @error('name') is-invalid @enderror"
                                        type="text" placeholder="Nama" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="ms-3 mb-3" style="font-size:0.8em!important">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                        name="gender" value="Laki-laki"
                                        {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                    <label class="ms-2 fw-normal">
                                        Laki-laki
                                    </label>
                                    <input class="ms-3 form-check-input @error('gender') is-invalid @enderror"
                                        type="radio" name="gender" value="Perempuan"
                                        {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                    <label class="ms-2 fw-normal">
                                        Perempuan
                                    </label>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input
                                            class="form-control form-control-user @error('username') is-invalid @enderror"
                                            type="text" placeholder="Username" name="username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6"><input
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            type="password" placeholder="Password" name="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3"><input
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        type="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control form-control-user @error('address') is-invalid @enderror" name="address" cols="10"
                                        rows="5" placeholder="Alamat" style="border-radius:30px!important">{{ old('textarea') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary d-block btn-user w-100" type="submit">Daftar</button>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="/login">Sudah punya akun? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

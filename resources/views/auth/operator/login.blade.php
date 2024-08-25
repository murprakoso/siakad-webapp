@extends('auth.layout')

@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="{{ asset('dist/img/bg-login.jpg') }}" alt="Login Image" class="img-fluid"
                                style="width: 100%; height:100%; object-fit: cover; object-position: center;">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    <div class="text-center mb-2">
                                        <span class="small">Silahkan login menggunakan akun Operator</span>
                                    </div>
                                </div>
                                @include('partials._flash')
                                <!-- Login Form -->
                                {!! html()->form('POST', route('operator.login.post'))->class('user')->open() !!}
                                <div class="form-group">
                                    {!! html()->text('username')->class('form-control form-control-user')->id('username')->placeholder('Masukkan Username...')->required() !!}
                                </div>
                                <div class="form-group">
                                    {!! html()->password('password')->class('form-control form-control-user')->id('password')->placeholder('Masukkan Password...')->required() !!}
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        {!! html()->checkbox('remember')->class('custom-control-input')->id('customCheck') !!}
                                        <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                    </div>
                                </div>
                                {!! html()->button('Login')->type('submit')->class('btn btn-primary btn-user btn-block') !!}
                                {!! html()->form()->close() !!}

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ url('/forgot-password') }}">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ url('/') }}">Kembali ke Beranda</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

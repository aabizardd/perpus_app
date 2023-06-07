@extends('layouts_auth.app')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/pages/auth.css" />
@endsection

@section('content')
    <h1 class="auth-title">Log in.</h1>
    <p class="auth-subtitle mb-5">
        Masuk dengan data Anda yang Anda masukkan saat pendaftaran.
    </p>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group position-relative mb-4">
            <input type="text" name="username" id="username"
                class="form-control form-control-xl  @error('username') is-invalid @enderror" placeholder="Username"
                value="{{ old('username') }}" />

            @error('username')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="form-group position-relative mb-4">
            <input type="password" name="password" id="password"
                class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password" />

            @error('password')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2" type="submit">
            Masuk
        </button>

    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold">Daftar akun</a>.
        </p>
        <p>
            <a class="font-bold" href="{{ route('password.request') }}">Lupa password?</a>.
        </p>
    </div>
@endsection

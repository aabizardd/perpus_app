@extends('layouts_auth.app')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/pages/auth.css" />
@endsection

@section('content')
    <h1 class="auth-title">Sign Up</h1>
    <p class="auth-subtitle mb-5">
        Masukkan data Anda untuk mendaftar ke situs web kami.
    </p>

    <form action="{{ route('register') }}" method="POST">

        @csrf

        <div class="form-group position-relative mb-4">
            <input type="text" id="name" name="name"
                class="form-control form-control-xl @error('name') is-invalid @enderror" placeholder="Name"
                value="{{ old('name') }}" />

            @error('name')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group position-relative mb-4">
            <input type="text" id="email" name="email"
                class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email"
                value="{{ old('email') }}" />

            @error('email')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group position-relative mb-4">
            <input type="text" id="username" name="username"
                class="form-control form-control-xl @error('username') is-invalid @enderror" placeholder="Username"
                value="{{ old('username') }}" />

            @error('username')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group position-relative mb-4">
            <input type="password" id="password" name="password"
                class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password" />

            @error('password')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group position-relative mb-4">
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="form-control form-control-xl" placeholder="Confirm Password" />

            @error('password')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2" type="submit">
            Daftar
        </button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold">Masuk</a>.
        </p>
    </div>
@endsection

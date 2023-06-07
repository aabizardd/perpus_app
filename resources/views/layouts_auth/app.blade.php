<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/app.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/custom.css" />



    @yield('addStyle')
    {{-- <link rel="stylesheet" href="assets/css/pages/auth.css" /> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">

                    </div>
                    @yield('content')
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>


@yield('addScript')

</html>

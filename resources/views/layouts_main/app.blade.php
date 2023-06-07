<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/bootstrap.css" />

    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/iconly/bold.css" />

    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/app.css" />
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/favicon.html" type="image/x-icon" />

    {{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/app.css" /> --}}

    @yield('addStyle')
    {{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/pages/auth.css" /> --}}

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="app">
        @include('layouts_main.sidebar')
        <div id="main">

            @include('layouts_main.header')

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; {{ get_title() }}</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart"></i></span> by
                            <a href="/">Velia</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('/') }}assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('/') }}assets/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('/') }}assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="{{ asset('/') }}assets/js/pages/dashboard.js"></script>

    <script src="{{ asset('/') }}assets/js/main.js"></script>
    @yield('addScript')

</body>


</html>

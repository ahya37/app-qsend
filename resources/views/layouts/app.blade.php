<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="chat ap">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons Icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icons/qsend.png') }}">

    <!-- Page Title Here -->
    <title>Qsend | @yield('title')</title>

    @stack('prepend-styles')

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/customcolor.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    @stack('addon-styles')

</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1 cs-bg-color"></div>
            <div class="sk-child sk-bounce2 cs-bg-color"></div>
            <div class="sk-child sk-bounce3 cs-bg-color"></div>
        </div>
    </div>

    <div id="main-wrapper">

        @include('layouts.navbar')

        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @include('layouts.footer')

    </div>

    @stack('prepend-scripts')
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/deznav-init.js')}}"></script>

    @stack('addon-scripts')

</body>

</html>

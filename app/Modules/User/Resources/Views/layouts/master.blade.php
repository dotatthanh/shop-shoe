<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Trang chủ</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap_web.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/media.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('slick/slick.css') }}" type="text/css">
    </head>

    <body>
        @include('user::layouts.header')

        @yield('content')

        @include('user::layouts.footer')

        <script src="{{ asset('js/jquery-2.2.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('slick/slick.js') }}"></script>
    </body>
</html>

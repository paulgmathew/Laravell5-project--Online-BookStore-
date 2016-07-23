<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ URL::secure('src/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ URL::secure('src/css/style.css')}}" />
        @yield('styles')
        <script type="text/javascript" src="{{ URL::secure('src/js/jquery-1.12.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::secure('src/js/bootstrap.min.js') }}"></script>
        @yield('scripts')
    </head>
    <body>
        @include('includes.nav')
        @yield('content')
    </body>
</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

<body class="authentication-bg" style="background-image: url({{ URL::asset('/assets/logo/background.png') }})">
    @yield('content')
    @include('layouts.vendor-scripts')
</body>

</html>

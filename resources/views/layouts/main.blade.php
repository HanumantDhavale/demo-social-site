<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    @yield('title')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>
<body>
@include('layouts.header')
<div class="container-fluid" style="min-height: 80vh;">
    @yield('content')
</div>
@include('layouts.footer')
<script src="{{asset('js/app.js')}}"></script>
@yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('layout.css')
</head>
<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        @include('layout.menu')
        <div class="page-wrapper">


            @yield('content')



        </div>
    </div>

@include('layout.js')
@yield('script')
</body>
</html>








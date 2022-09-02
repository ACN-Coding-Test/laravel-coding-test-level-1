<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <link href="{!! asset('css/bootstrap.min.css')!!}" rel="stylesheet">
    <link href="{!! asset('css/font-awesome.min.css')!!}" rel="stylesheet">
    <link href="{!! asset('css/styles.css')!!}" rel="stylesheet">
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    @yield('content') 
    <input id="crf_token" value="{{ csrf_token() }}" type="hidden">
    <!-- End wrapper-->


<!-- Bootstrap core JavaScript-->   
    <script src="{!! asset('js/jquery-1.11.1.min.js')!!}"></script>
    <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
    <script src="{!! asset('js/custom.js?v=1')!!}"></script>
    @yield('script') 
</body>
</html>

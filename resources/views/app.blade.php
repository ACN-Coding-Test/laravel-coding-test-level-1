<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zoul EventManager') }}</title>
    <link rel="shortcut icon" href="img/logo.ico">


    <!-- Styles -->
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css" rel="stylesheet">

</head>
<body>
    
    <div id="app">

    </div>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>

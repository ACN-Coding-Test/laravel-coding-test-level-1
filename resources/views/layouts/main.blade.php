<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title> {{env("APP_NAME")}}</title>
</head>
<body>
    <header>
        @include('layouts.navbars.nav')
    </header>
    <main class="container-app">
        @yield('content')
    </main>
    <footer>
        <script src="{{asset("js/app.js")}}"></script>
    </footer>
</body>
</html>
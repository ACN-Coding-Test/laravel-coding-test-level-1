<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" integrity="sha384-X8QTME3FCg1DLb58++lPvsjbQoCT9bp3MsUU3grbIny/3ZwUJkRNO8NPW6zqzuW9" crossorigin="anonymous">
    <!-- Scripts -->
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" id="rightnav">

                        <!-- Authentication Links -->


                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        const token = localStorage.getItem('api_token');

        let navigation = [];

        if(token === undefined || token === null){
             navigation = [
                {name: 'login', id: 'login', to: {name: 'login'}},
                {name: 'register', id: 'register', to: {name: 'register'}},
            ];

            // window.location.href = '/login';

        }else{
            navigation = [
                {name: 'events', id: 'events', to: {name: 'events'}},
                {name: 'create events', id: 'login',to: {name: 'events/create'}},
                {name: 'Sign out', id: 'logout', to: {name: 'logout'}},
            ]
        }


        $.each(navigation, function (key, item) {
            $('#rightnav').append('<li class="nav-item">\
                <a class="nav-link" id="'+item.id+'" href="'+item.to.name+'">'+item.name+'</a>\
        </li>');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': "Bearer "+token
            }
        });

        $(document).on('click', '#logout', function (e) {
            e.preventDefault();

            // $(this).text('Sending..');

            $.ajax({
                type: "POST",
                url: "/api/v1/auth/logout",
                dataType: "json",
                success: function (response) {
                    $('#errors').html("").removeClass('alert alert-danger');
                    $('#success_message').addClass('alert alert-success').text('successfully updated');
                    $('#register').text('Save');

                    localStorage.removeItem('api_token');

                    window.location.href = '/login';
                },
                error: function (error) {
                    $('#errors').html("").addClass('alert alert-danger');
                    $.each(error.responseJSON.errors, function (key, err_value) {
                        $('#errors').append('<li>' + err_value[0] + '</li>');
                    });
                    $('#register').text('Save');
                }
            });

        });

    </script>

    @yield('scripts')
</body>
</html>

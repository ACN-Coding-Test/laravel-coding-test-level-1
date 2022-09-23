@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="#">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="login_btn">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#login_btn', function (e) {
                e.preventDefault();

                $(this).text('Sending..');

                const data = {
                    'email': $('#email').val(),
                    'password': $('#password').val(),
                }

                const token = localStorage.getItem('api_token');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/api/v1/auth/login",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        $('#errors').html("").removeClass('alert alert-danger');
                        $('#success_message').addClass('alert alert-success').text('successfully updated');
                        $('#register').text('Save');


                        localStorage.setItem('api_token', response.data.token);

                        window.location.href = '/events';
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

        });


    </script>
@stop

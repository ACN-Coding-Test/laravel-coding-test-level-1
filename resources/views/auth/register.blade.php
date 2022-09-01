@extends('layouts.login.app')
@section('content')
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <h3 class="panel-title">Sign Up</h3>
                    </div>
                    <div class="panel-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input id="name" type="name" class="form-control input-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus aria-describedby="nameHelp" placeholder="{{ __('Name') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control input-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="{{ __('E-Mail Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" placeholder="{{ __('Password') }}" id="password" type="password" class="form-control input-sm @error('password') is-invalid @enderror" name="password" >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" placeholder="{{ __('Confirm Password') }}" id="password" type="password" class="form-control input-sm @error('password') is-invalid @enderror" name="password_confirmation" >
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Register" class="btn btn-info btn-block">
                    </form>
                    <hr>
                    <div class="text-center">                                
                        @if (Route::has('password.request'))                    
                            <a href="{{route('password.request')}}" class="small">{{ __('Forgot Your Password?') }}</a>
                        @endif   
                    </div>
                    <div class="text-center">
                        <a class="small" href="{{url('/login')}}">{{ __('Already have an account? Login!')}}</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
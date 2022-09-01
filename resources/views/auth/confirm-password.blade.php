@extends('layouts.login.app')
@section('content')
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Confirm Password</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="form-group">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="{{ __('Password') }}" id="password" type="password" class="form-control input-sm @error('password') is-invalid @enderror" name="password" >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input type="submit" value="{{ __('Confirm') }}" class="btn btn-info btn-block">
                </form>
                <hr>
                <div class="text-center">                                
                    @if (Route::has('password.request'))                    
                        <a href="{{route('password.request')}}" class="small">{{ __('Forgot Your Password?') }}</a>
                    @endif   
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.login.app')
@section('content')
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Verify Email</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div class="form-group">
                         {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>
                    @if (session('status') == 'verification-link-sent')
                        <div class="form-group">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif
                    <input type="submit" value="{{ __('Resend Verification Email') }}" class="btn btn-info btn-block">
                </form>
                <hr>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" value="{{ __('Log Out') }}" class="btn btn-info btn-block">
                </form>
                
            </div>
        </div>
    </div>
@endsection
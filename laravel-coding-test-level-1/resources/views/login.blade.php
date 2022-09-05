@extends('layout')
@section('content')

<div class="container">
    <div class="col-md-6">
        <h1>Login</h1>

        @if(Session::has('fail'))
            <div class="alert alert-danger">
            {{Session::get('fail')}}
            </div>
        @endif

        <form action="login" method="post">
            {!! csrf_field() !!}
            
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" required>

            <label for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password" required>

            <br>
            <button class="btn btn-success">Login</button>
            <p><a href="register">Don't have account?</a></p>
        </form>

    </div>
    
</div>
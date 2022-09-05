@extends('layout')
@section('content')

<div class="container">
    <div class="col-md-6">
        <h1>Register</h1>

        @if(Session::has('fail'))
            <div class="alert alert-danger">
            {{Session::get('fail')}}
            </div>
        @endif

        <form action="register" method="post">
            {!! csrf_field() !!}
            <label for="name">Name</label>
            <input class="form-control" id="name" type="text" name="name" required>

            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" required>

            <label for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password" required>

            <label for="confirmP">Confirm Password</label>
            <input class="form-control" id="confirmP" type="password" name="confirmP" required>

            <br>
            <button class="btn btn-success">Register</button>
            <p><a href="login">already have account?</a></p>
        </form>

    </div>
    
</div>
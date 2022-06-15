@extends("layouts.main")
@section('content')
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="d-flex justify-content-center pt-2">

        <form class="basic__form" action="{{ route('login') }}" method="post">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" name="email" class="form-control" required/>
                <label class="form-label" for="form2Example1">Email address</label>
            </div>
    
            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control" required/>
                <label class="form-label" for="form2Example2">Password</label>
            </div>
    
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
    
            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="{{route("register")}}">Register</a></p>
            </div>
        </form>
    </div>
@endsection

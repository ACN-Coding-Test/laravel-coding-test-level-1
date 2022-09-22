@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Welcome to dashboard</h4>
                    </br>
                    <!-- <h5 class="underline"><a href="{{ url('/events') }}"><b>List of Events</b></a></h5> -->
                    <a class="btn btn-info" href="{{ url('events') }}"> List of Events </a>
                    <a class="btn btn-info" href="{{ url('fetch') }}"> Call External API </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

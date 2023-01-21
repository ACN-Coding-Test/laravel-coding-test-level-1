@extends('layouts.master')

@section('container')
    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between bg-dark">
                        <h5 class="card-title text-light">Create Events</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('/events/insert') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Event Name</label>
                                    <input type="text" name="name" class="form-control">
                                    <div id="event" class="form-text">Slug will generate based on event name</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Event Start and End</label>
                                    <input type="text" name="date" id="date" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('/events') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

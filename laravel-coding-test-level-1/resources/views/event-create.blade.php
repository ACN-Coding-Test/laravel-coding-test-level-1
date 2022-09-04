@extends('layout')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Create Event</div>
            <div class="card-body">
                <form action="{{url('/events')}}" method="POST">
                    {!! csrf_field() !!}
                    <div class="row">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="row">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>
                    <div class="row">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="3" id="description" required></textarea>
                    </div>
                    <div class="row">
                        <label for="startAt">Start At</label>
                        <input type="datetime-local" step="any" name="startAt" id="startAt" class="form-control" required>
                    </div>
                    <div class="row">
                        <label for="endAt">End At</label>
                        <input type="datetime-local" step="any" name="endAt" id="endAt" class="form-control" required>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1">
                            <input type="submit" value="Save" class="btn btn-success"><br>
                        </div>
                        <div class="col-md-1">
                            <input type="reset" value="Clear" class="btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <a href="/events" class="btn btn-info">Back</a>
    </div>
    
</div>

@endsection
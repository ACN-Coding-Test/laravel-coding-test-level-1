@extends('layout')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Edit Event</div>
            <div class="card-body">
                <form action="/events/{{$event->id}}" method="POST">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <div class="row">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$event->name}}" required>
                    </div>
                    <div class="row">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{$event->slug}}" required>
                    </div>
                    <div class="row">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="3" id="description" value="{{$event->description}}" required>{{$event->description}}</textarea>
                    </div>
                    <div class="row">
                        <label for="startAt">Start At</label>
                        <input type="datetime-local" step="any" name="startAt" id="startAt" class="form-control" value="{{$event->startAt}}" required>
                    </div>
                    <div class="row">
                        <label for="endAt">End At</label>
                        <input type="datetime-local" step="any" name="endAt" id="endAt" class="form-control" value="{{$event->endAt}}" required>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1">
                            <input type="submit" value="Save" class="btn btn-success"><br>
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
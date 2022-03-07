@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update an event</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('events.update', $event->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="name">Event Name:</label>
                <input type="text" class="form-control" name="name" value="{{$event->name}}" autocomplete="off" />
            </div>
            <div class="form-group">    
                <label for="startAt">Start At:</label>
                <input class="date form-control" type="text" name="startAt" value="{{$event->startAt}}" autocomplete="off">
            </div>
            <div class="form-group">    
                <label for="endAt">End At:</label>
                <input class="date form-control" type="text" name="endAt" value="{{$event->endAt}}" autocomplete="off">
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
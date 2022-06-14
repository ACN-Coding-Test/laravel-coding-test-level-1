@extends('main')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <form action="{{route("events.store")}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$event->name}}">
            </div>
            <div class="form-group">
                <label for="name">Started Date</label>
                <input type="datetime" name="start_date" id="start_date" class="form-control" value="{{$event->startAt}}">
            </div>
            <div class="form-group">
                <label for="name">End Date</label>
                <input type="datetime" name="end_date" id="end_date" class="form-control" value="{{$event->endAt}}">
            </div>
            <div>
                <button class="btn btn-info btn-sm"> Update</button>
            </div>
        </form>
    </div>
   
@endsection
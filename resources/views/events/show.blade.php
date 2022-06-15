@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <form class="basic__form"  action="{{route("events.store")}}" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$event->name}}">
            </div>
            <div class="form-group">
                <label for="name">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{$event->slug}}">
            </div>
            <div class="form-group">
                <label for="name">Started Date</label>
                <input type="datetime" name="start_date" id="start_date" class="form-control" value="{{$event->startAt}}">
            </div>
            <div class="form-group">
                <label for="name">End Date</label>
                <input type="datetime" name="end_date" id="end_date" class="form-control" value="{{$event->endAt}}">
            </div>
            <div class="d-flex gap-1">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm" disabled> Back</a>
            </div>
        </form>
    </div>
@endsection
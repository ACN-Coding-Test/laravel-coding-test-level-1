@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <form class="basic__form"  action="{{route("events.store")}}" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group pt-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$event->name}}" required autocomplete="off"> 
            </div>
            <div class="form-group pt-2">
                <label for="name">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{$event->slug}}" required autocomplete="off"> 
            </div>
            <div class="form-group pt-2">
                <label for="name">Started Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{$event->startAt}}" required autocomplete="off"> 
            </div>
            <div class="form-group pt-2">
                <label for="name">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{$event->endAt}}" required autocomplete="off"> 
            </div>
            <div class="d-flex justify-content-between gap-1 pt-2">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm" disabled> Back</a>
                <button class="btn btn-info btn-sm"> Update</button>
            </div>
        </form>
    </div>
   
@endsection
@extends('layout')
@section('content')

<div class="container">
        <div class="card">
            <h1>Event</h1>
        </div>
        <div class="card-body">
            <h5 class="card-title">Event Title: {{$event->name}}</h5>
            <p class="card-text"><b>Slug: </b>{{$event->slug}}</p>
            <p class="card-text"><b>Description: </b>{{$event->description}}</p>
            <p class="card-text"><b>Created At: </b>{{$event->createdAt}}</p>
            <p class="card-text"><b>Updated At: </b>{{$event->updatedAt}}</p>
            <p class="card-text"><b>Start At: </b>{{$event->startAt}}</p>
            <p class="card-text"><b>End At: </b>{{$event->endAt}}</p>
        </div>
        <hr>
        <a href="/events" class="btn btn-info">Back</a>
    </div>

@endsection
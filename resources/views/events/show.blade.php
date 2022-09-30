@extends('layouts.app')

@section('title', 'Event')

@section('content')
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card mt-3 ">
			  <div class="card-body">
			  	<h2 class="card-title">{{$event->name}}</h2>
			  	<hr>
    			<h6 class="card-subtitle mb-2 text-muted"><em>Slug: {{$event->slug}}</em></h6>
    			<h6 class="card-subtitle mb-2 text-muted">Starts At: {{$event->startAt}}</h6>
    			<h6 class="card-subtitle mb-2 text-muted">Ends At: {{$event->endAt}}</h6>
    			<small class="text-muted"><em>Created At:{{$event->createdAt}}</em></small><br>
    			<small class="text-muted"><em>Updated At:{{$event->updatedAt}}</em></small><br>

			    <a href="{{url('events/'.$event->id.'/edit')}}" class="btn btn-primary pull-right mt-4">Edit</a>
			    <a href="{{url('events/')}}" class="btn btn-secondary pull-left mr-2  mt-4">Back</a>
			  </div>
			</div>
		</div>
	</div>
			
		
@endsection
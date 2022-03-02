@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Events</h1>    
    <div>
        <a style="margin: 19px;" href="{{ route('events.create')}}" class="btn btn-primary">New event</a>
        </div> 
    @include('events.search')
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Event Name</td>
          <td>Slug</td>
          <td>Start At</td>
          <td>End At</td>
          <td>Created At</td>
          <td>Updated At</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    @if (!empty($events))
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->name}}</td>
            <td>{{$event->slug}}</td>
            <td>{{$event->startAt}}</td>
            <td>{{$event->endAt}}</td>
            <td>{{$event->createdAt}}</td>
            <td>{{$event->updatedAt}}</td>
            <td>
                <a href="{{ route('events.edit',$event->id)}}" class="btn btn-primary">Update</a>
            </td>
            <td>
                <form action="{{ route('events.destroy', $event->id)}}" method="post">
                <form action="" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    @else
        <h1> No Events </h1>
    @endif
  </table>
  @if (!empty($events))      
  {{ $events->onEachSide(3)->links() }}
  @endif
<div>
</div>
@endsection
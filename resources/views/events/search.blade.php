@extends('events.layouts.events')

@section('main-content')

<h1>List of Events</h1>

<hr>

@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('search') }}" method="GET">
    @csrf
    <input type="text" name="search" placeholder="search...">
</form>

<div style="float: right;">
    <a class="btn btn-dark" href="{{ route('events.index') }}">Go back to homepage</a>
    <a class="btn btn-success" href="{{ route('events.create') }}">Add New Event</a>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>  
      <th scope="col">Name</th>
      <th scope="col">Slug</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
      <tbody>
            @if($events->isNotEmpty())
                @foreach ($events as $event)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->slug }}</td>
                        <td>{{ $event->created_at }}</td>
                        <td>{{ $event->updated_at }}</td>
                        <td>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">

                                <a class="btn btn-info" href="{{ route('events.edit', $event->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>  
                @endforeach
            @else 
                <div>
                    <h2 style="padding: 20px 0px;">No event found</h2>
                </div>
            @endif
      </tbody>
</table>



@endsection
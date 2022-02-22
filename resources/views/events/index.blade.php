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

<div style="float: right; margin-bottom: 10px;">
    <a class="btn btn-dark" href="{{ route('fetch') }}">Call External API</a>
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
    @foreach($events as $event)
    <tr>
        <td>{{ ++$count }}</td>
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
  </tbody>
</table>

{{ $events->links() }}

@endsection
@extends('events.layouts.events')

@section('main-content')

<h1>Show Individual Event</h1>

<hr>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Slug</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated At</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>{{ $event->name }}</td>
        <td>{{ $event->slug }}</td>
        <td>{{ $event->created_at }}</td>
        <td>{{ $event->updated_at }}</td>
    </tr>
  </tbody>
</table>

<a class="btn btn-dark" href="{{ route('events.index') }}">Back</a>

@endsection
@extends('events.layouts.events')

@section('main-content')

<h1>Call External API</h1>

<hr>

<div style="float: right; margin-bottom: 10px;">
    <a class="btn btn-dark" href="{{ route('events.index') }}">Go back to homepage</a>
    <a class="btn btn-success" href="{{ route('fetch') }}">Call External API</a>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">API</th>
      <th scope="col">Description</th>
      <th scope="col">Category</th>
      <th scope="col">Link</th>
    </tr>
  </thead>
  <tbody>
    @foreach($randoms as $random)
    <tr>
        <td>{{ $random['API'] }}</td>
        <td>{{ $random['Description'] }}</td>
        <td>{{ $random['Category'] }}</td>
        <td><a href="{{ $random['Link'] }}">{{ $random['Link'] }}</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
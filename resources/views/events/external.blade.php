@extends('events.layouts.events')

@section('main-content')

<h1>Call External API</h1>

<hr>

<div style="float: right; margin-bottom: 10px;">
    <a class="btn btn-success" href="{{ route('events.index') }}">List of Events</a>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">API</th>
      <th scope="col">Description</th>
      <th scope="col">Auth</th>
      <th scope="col">HTTPS</th>
      <th scope="col">Cors</th>
      <th scope="col">Category</th>

    </tr>
  </thead>
  <tbody>
    @foreach($randoms as $key => $random)

    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $random['API'] }}</td>
        <td>{{ $random['Description'] }}</td>
        <td>{{ $random['Auth'] }}</td>
        <td>{{ $random['HTTPS'] }}</td>
        <td>{{ $random['Cors'] }}</td>
        <td>{{ $random['Category'] }}</td>

    </tr>
    @endforeach
  </tbody>
</table>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(session('message'))
            <div class="col-3 d-flex">
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Start</th>
                <th scope="col">End</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($events as $event)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="{{ route('events.show', ['event'=>$event->id]) }}">{{ $event->name }}</a></td>
                    <td>{{ $event->startAt }}</td>
                    <td>{{ $event->endAt }}</td>
                    <td><form action="{{ route('events.destroy', ['event'=>$event->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-success"><a href="{{ route('events.edit', ['event'=>$event->id]) }}" style="text-decoration: none; color: white">Edit</a></button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection

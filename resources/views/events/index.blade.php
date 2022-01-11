@extends('layouts.app')

@section('content')
<style type="text/css">
.flex.flex-1 { margin-top: 10px; margin-bottom: 16px; }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="events/create" class="btn btn-primary mb-2">Create Event</a> 
            <br>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created at</th>
                        <th>Updated At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)

                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->slug }}</td>
                        <td>{{ date('d/m/Y h:i:s A', strtotime($event->createdAt)) }}</td>
                        <td>{{ date('d/m/Y h:i:s A', strtotime($event->updatedAt)) }}</td>
                        <td>
                            <a href="events/{{ $event->id }}" class="btn btn-success">Show</a>
                            <a href="events/{{ $event->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="events/{{ $event->id }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div> 
    </div>
    {{ $events->links() }}
</div>
@endsection


@extends('main')
@section('content')
<div class="container">
    <table class="table border">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <thead>
            <tr>
                {{-- <th>Id</th> --}}
                <th>Name</th>
                <th>Slug</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    {{-- <td>{{$event->id}}</td> --}}
                    <td>{{$event->name}}</td>
                    <td>{{$event->slug}}</td>
                    <td>{{date("F m, Y", strtotime($event->startAt))}}</td>
                    <td>{{date("F m, Y", strtotime($event->endAt))}}</td>
                    <td>{{date("F m, Y", strtotime($event->createdAt))}}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{route("events.show", $event->id)}}" class="btn btn-sm btn-info">View</a>
                            <form action="{{route("events.destroy", $event->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end"> {{ $events->links() }}</div>

</div>
@endsection


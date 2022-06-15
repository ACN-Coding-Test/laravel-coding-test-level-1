
@extends('layouts.main')
@section('content')
<div class="container">
    @permission('events-create')
        <div class="d-flex justify-content-end pb-2">
            <a href="{{route("events.create")}}" class="btn btn-sm btn-success"> Add Event</a>
        </div>
    @endpermission
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
                <th class="text-end">Action</th>
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
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{route("events.show", $event->id)}}" class="btn btn-sm btn-info">View</a>
                            @permission("events-create")
                                <a href="{{route("events.edit", $event->id)}}" class="btn btn-sm btn-warning">Update</a>
                                <form action="{{route("events.destroy", $event->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endpermission
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end"> {{ $events->links() }}</div>
</div>
@endsection


@extends('layout')
@section('content')

<div class="container">
        <h1><a href="/events" class="text-dark" style='text-decoration:none;'>Events</a></h1>

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        @if(Session::has('fail'))
            <div class="alert alert-danger">
            {{Session::get('fail')}}
            </div>
        @endif
        
        <a href="{{url('/events/create')}}" class="btn btn-success float-end"><i class="fa fa-plus" aria-hidden="true"></i> Create Event</a>
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                <form class="row ms-auto float-end" method="GET">
                    <div class="col-8">
                        <input id="search" type="text" name="query" placeholder="Search Event" class="form-control input-sm">               
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            
        </div>
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Slug</th>
                <th>Create At</th>
                <th>Udpated At</th>
                <th>Start At</th>
                <th>End At</th>
                <th colspan='2'>Action</th>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td><a href="/events/{{$event->id}}">{{$event->name}}</a></td>
                    <td>{{$event->slug}}</td>
                    <td>{{$event->createdAt}}</td>
                    <td>{{$event->updatedAt}}</td>
                    <td>{{$event->startAt}}</td>
                    <td>{{$event->endAt}}</td>
                    <td><a href="/events/{{$event->id}}/edit" class="btn btn-info btn-sm">Update</a></td>
                    <td>
                        <form method="POST" action="/events/{{$event->id}}" accept-charset="UTF-8" style="display:inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm('Confirm delete')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{$events->links()}}
    </div>

@endsection

<script>
        setInterval(function(){
            $('.alert').fadeOut(300);
        },3000);
</script>
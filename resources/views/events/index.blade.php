@extends('layouts.app')

@section('content')
<div class="py-4 my-4">
    <h2 class="card-title">
        <strong>Events</strong>
        @if(Auth::check())
        <span class="float-end">
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>&nbsp; New Event
            </a>
        </span>
        @endif
    </h2>

    <div class="search-field py-4">
        <form action="" method="GET">
            <div class="row">
                <div class="col-10">
                    <input type="text" class="form-control" name="query" placeholder="Search here..">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary text-center" style="width: 100%;"><i class="fas fa-search"></i>&nbsp; Search</button>
                </div>
            </div>
        </form>
    </div>

    @include('includes.message')

    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr class="my-4">
                    <th scope="col" class="col-1 text-center">#</th>
                    <th scope="col" class="col-4">Name</th>
                    <th scope="col" class="col-1 text-center">Start At</th>
                    <th scope="col" class="col-1 text-center">End At</th>
                    <th scope="col" class="col-1 text-center">Created At</th>
                    <th scope="col" class="col-1 text-center">Updated At</th>
                    <th scope="col" class="col-1 text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>
                        <label class="h5">
                            <strong>IT Mega Sale 2022</strong>
                        </label>
                        <small>it-mega-sale-2022</small>
                    </td>
                    <td class="text-center">
                        2022-10-12 19:57:23
                    </td>
                    <td class="text-center">
                        2023-09-21 05:05:02
                    </td>
                    <td class="text-center">
                        2022-02-19 06:21:20
                    </td>
                    <td class="text-center">
                        2022-02-19 06:29:02
                    </td>
                    <td class="text-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary">Left</button>
                            <button type="button" class="btn btn-primary">Middle</button>
                        </div>
                    </td>
                </tr> -->
                @php
                $i = 1;
                @endphp
                @foreach ($events as $event)
                <tr>
                    <th scope="row" class="text-center align-middle">{{ $i++ }}</th>
                    <td class="align-middle">
                        <label class="h5">
                            <strong>{{ $event->name }}</strong>
                        </label>
                        <br>
                        <small>{{ $event->slug }}</small>
                    </td>
                    <td class="text-center align-middle">
                        {{ $event->startAt }}
                    </td>
                    <td class="text-center align-middle">
                        {{ $event->endAt }}
                    </td>
                    <td class="text-center align-middle">
                        {{ $event->createdAt }}
                    </td>
                    <td class="text-center align-middle">
                        {{ $event->updatedAt }}
                    </td>
                    <td class="text-end align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(Auth::check())
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit{{substr($event->id,0,7)}}">
                                <i class="fas fa-edit"></i>
                            </a> -->
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{substr($event->id,0,7)}}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $events->links() !!}
    </div>

</div>

<!-- Modal starts here -->
@foreach($events as $event)
<div class="modal fade" id="edit{{substr($event->id,0,7)}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('events.update', ['id' => $event->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="event-name" class="form-label">
                            Event Name
                        </label>
                        <input type="text" class="form-control" id="event-name" name="name" required value="{{ $event->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="start-at" class="form-label">
                            Start At
                        </label>
                        <div class="row">
                            <div class="col-6">
                                <input type="date" class="form-control" id="start-at" name="startAt_date" required value="{{ date('Y-m-d', strtotime($event->startAt)) }}">
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" name="startAt_time" required value="{{ date('H:i', strtotime($event->startAt)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="end-at" class="form-label">
                            End At
                        </label>
                        <div class="row">
                            <div class="col-6">
                                <input type="date" class="form-control" id="end-at" name="endAt_date" required value="{{ date('Y-m-d', strtotime($event->endAt)) }}">
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" name="endAt_time" required value="{{ date('H:i', strtotime($event->endAt)) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-close"></i>&nbsp; Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>&nbsp; Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@foreach($events as $event)
<div class="modal fade" id="delete{{substr($event->id,0,7)}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('events.destroy', ['id' => $event->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this event?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>&nbsp; Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>&nbsp; Delete
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
<!-- Modal ends here -->

@endsection
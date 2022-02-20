@extends('layouts.app')

@section('content')
<div class="py-4 my-4">
    <h2 class="card-title">
        <strong>Events</strong>
        @if(Auth::check())
        <span class="float-end">
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info">
                <i class="fas fa-edit"></i>&nbsp; Edit
            </a>
            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{substr($event->id,0,7)}}">
                <i class="fas fa-trash"></i>&nbsp; Delete
            </a>
        </span>
        @endif
    </h2>
    <h6>
        <a href="{{ route('events.index') }}">Event</a> > Show
    </h6>

    @include('includes.message')

    <div class="create-event py-4">

        <div class="table table-responsive">
            <table class="table table-bordered table-hover">
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">ID</td>
                    <td class="col-9">{{ $event->id }}</td>
                </tr>
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">Name</td>
                    <td class="col-9 h5">{{ $event->name }}</td>
                </tr>
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">Slug</td>
                    <td class="col-9">{{ $event->slug }}</td>
                </tr>
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">Start At</td>
                    <td class="col-9">{{ $event->startAt }}</td>
                </tr>
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">End At</td>
                    <td class="col-9">{{ $event->endAt }}</td>
                </tr>
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">Created At</td>
                    <td class="col-9">{{ $event->createdAt }}</td>
                </tr>
                <tr class="my-4">
                    <td class="col-3 bg-dark text-white">Updated At</td>
                    <td class="col-9">{{ $event->updatedAt }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>

<!-- Modal starts here -->
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
<!-- Modal ends here -->
@endsection
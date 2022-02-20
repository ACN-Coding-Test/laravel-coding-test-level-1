@extends('layouts.app')

@section('content')
<div class="py-4 my-4">
    <h2 class="card-title"><strong>Events</strong></h2>
    <h6><a href="{{ route('events.index') }}">
            Event</a> > Edit
    </h6>

    @include('includes.message')

    <div class="create-event py-4">
        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PATCH')
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
                        <input type="time" class="form-control" name="startAt_time" required value="{{ date('h:i', strtotime($event->startAt)) }}">
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
                        <input type="time" class="form-control" name="endAt_time" required value="{{ date('h:i', strtotime($event->endAt)) }}">
                    </div>
                </div>
                <div class="button-group mt-4 text-end">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-eraser"></i>&nbsp; Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>&nbsp; Update
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
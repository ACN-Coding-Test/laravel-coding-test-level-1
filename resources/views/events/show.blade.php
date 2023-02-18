@extends('layouts.app')

<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('event.update', ['id' => $event->id]) }}" method="POST" enctype="multipart/form-data"
            id="editEventModal" class="need-validation">
            {{ csrf_field() }}
            <div class="modal-body">
                <input id="id" name="id" type="hidden" value="">
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $event->name }}">
                </div>
                <div class="form-group">
                    <label for="start_at" class="form-control-label">Start at</label>
                    <input class="form-control" type="datetime-local" id="start_at" name="start_at"
                        value="{{ Carbon\Carbon::parse($event->start_at)->toDateTimeLocalString() }}">
                </div>
                <div class="form-group">
                    <label for="end_at" class="form-control-label">End at</label>
                    <input class="form-control" type="datetime-local" id="end_at" name="end_at"
                        value="{{ Carbon\Carbon::parse($event->end_at)->toDateTimeLocalString() }}">
                </div>
                <div class="form-group">
                    <label for="slug" class="form-control-label">Description</label>
                    <textarea class="form-control" id="slug" name="slug">{{ $event->slug }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('event.index') }}" class="btn bg-gradient-secondary">Close</a>
                <button type="submit" class="btn bg-gradient-primary">Submit</button>
        </form>
    </div>
</div>
</div>

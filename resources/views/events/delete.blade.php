@extends('layouts.app')

<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Confirm to delete this event?</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>This action is not reversible!</p>
        </div>
        <div class="modal-footer">
            <a href="{{ route('event.index') }}" class="btn bg-gradient-secondary">Close</a>
            <form action="{{ route('event.delete', ['id' => $event->id]) }}" method="POST" id="deleteFormEvent">
                {{ csrf_field() }}
                <input id="id" name="id" type="hidden" value="">
                <button class="btn bg-gradient-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>

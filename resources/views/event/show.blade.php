@extends('layouts.master')

@section('container')
    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between bg-dark">
                        <h5 class="card-title text-light">View Events</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Event Name</label>
                                <input type="text" class="form-control" readonly value="{{ $event->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" readonly value="{{ $event->slug }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event Start</label>
                                <input type="text" class="form-control" readonly value="{{ $event->startAt }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event End</label>
                                <input type="text" class="form-control" value="{{ $event->endAt }}">
                            </div>
                            <a href="{{ url('/events') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

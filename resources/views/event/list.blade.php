@extends('layouts.master')

@section('container')
    <main>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-lg-12">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between bg-dark">
                        <h5 class="card-title text-light">Events</h5>
                        <a href="{{ url('/events/create') }}" class="btn btn-primary float-end">Create Event</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Event</th>
                                            <th>Slug</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($events as $e)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td>{{ $e->name }}</td>
                                            <td>{{ $e->slug }}</td>
                                            <td>{{ $e->startAt }}</td>
                                            <td>{{ $e->endAt }}</td>
                                            <td class="text-center" style="width: 30%">
                                                <a href="{{ url('/events/view/'.$e->id) }}" class="btn btn-primary">Show Event</a>
                                                <a href="{{ url('/events/edit/'.$e->id) }}" class="btn btn-warning">Edit Event</a>
                                                <a href="{{ url('/events/delete/'.$e->id) }}" class="btn btn-danger">Delete Event</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

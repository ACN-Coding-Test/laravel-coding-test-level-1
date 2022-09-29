@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="row">
                <div class="col">
                    <form class="row g-3">
                        <div class="col-auto">
                            <h3 class="">Event List</h3>
                        </div>
                        @if (Auth::check())
                            <div class="col-auto">
                                <button type="button" class="btn btn-md btn-success btn-round btn-icon mb-3" data-bs-toggle="modal" data-bs-target="#eventCreate">Create</button>
                            </div>
                        @endif
                    </form>
                    <hr>
                    @include('event.modal.create')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table id="eventTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            @if (Auth::check())
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="col-5"><a class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#eventView{{$event['id']}}">{{$event['name']}}</a></td>
                                <td class="col-5">{{$event['slug']}}</td>
                                @if (Auth::check())
                                    <td class="col-2 text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-md btn-primary btn-round btn-icon me-2" data-bs-toggle="modal" data-bs-target="#eventEdit{{$event['id']}}">Update</button>
                                            <button type="button" class="btn btn-md btn-danger btn-round btn-icon" data-bs-toggle="modal" data-bs-target="#eventDelete{{$event['id']}}">Delete</button>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            @include('event.modal.view')
                            @include('event.modal.edit')
                            @include('event.modal.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
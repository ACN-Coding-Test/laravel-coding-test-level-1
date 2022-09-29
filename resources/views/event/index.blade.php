<!DOCTYPE html>
<html lang="en">
    @extends('layouts.app')
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><strong>Coding Test</strong></a>
        </div>
    </nav>
    <br>
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
                            <div class="col-auto">
                                <button type="button" class="btn btn-md btn-success btn-round btn-icon mb-3" data-bs-toggle="modal" data-bs-target="#eventCreate">Create</button>
                            </div>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td class="col-5"><a class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#eventView{{$event['id']}}">{{$event['name']}}</a></td> {{-- href="{{route('showEvent',$event['id'])}}" --}}
                                    <td class="col-5">{{$event['slug']}}</td>
                                    <td class="col-2 text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-md btn-primary btn-round btn-icon me-2" data-bs-toggle="modal" data-bs-target="#eventEdit{{$event['id']}}">Update</button>
                                            <button type="button" class="btn btn-md btn-danger btn-round btn-icon" data-bs-toggle="modal" data-bs-target="#eventDelete{{$event['id']}}">Delete</button>
                                            
                                            {{-- <form action="{{route('updateEvent',$event['id'])}}" method='POST'>
                                                @csrf
                                                @method('POST')
                                                <button type='submit' value={{ $event['id'] }} class="btn btn-md btn-primary btn-round btn-icon me-2">Update</button>
                                            </form>
                                            <form action="{{route('destroyEvent',$event['id'])}}" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' value={{ $event['id'] }} class="btn btn-md btn-danger btn-round btn-icon">Delete</button>
                                            </form> --}}
                                        </div>
                                    </td>
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
</body>
</html>
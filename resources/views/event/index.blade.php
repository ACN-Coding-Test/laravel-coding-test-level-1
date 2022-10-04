@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-left">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="#">Weather</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Date Forecasting</h3><hr>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            @foreach ( $weathers['days'] as $key => $weather)
                            <div class="carousel-item {{$key == 0 ? 'active':''}}">
                                <div class="row">
                                    <div class="col-2">
                                        <p class="card-text"><strong>Location</strong></p>
                                        <p class="card-text"><strong>Timezone</strong></p>
                                        <p class="card-text"><strong>Date</strong></p>
                                        <p class="card-text"><strong>Temperature</strong></p>
                                        <p class="card-text"><strong>Description</strong></p>
                                        <p class="card-text"><strong>Condition</strong></p>
                                        <p class="card-text"><strong>Sunrise</strong></p>
                                        <p class="card-text"><strong>Sunset</strong></p>
                                    </div>
                                    <div class="col">
                                        <p class="card-text"> : {{$weathers['resolvedAddress']}}</p>
                                        <p class="card-text"> : {{$weathers['timezone']}}</p>
                                        <p class="card-text"> : {{date('l', strtotime($weather['datetime'])) . ' (' .$weather['datetime'].')'}}</p>
                                        <p class="card-text"> : {{$weather['temperature']}} <span>&#8451;</span></p>
                                        <p class="card-text"> : {{$weather['description']}}</p>
                                        <p class="card-text"> : {{$weather['conditions']}}</p>
                                        <p class="card-text"> : {{$weather['sunrise']}}</p>
                                        <p class="card-text"> : {{$weather['sunset']}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
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
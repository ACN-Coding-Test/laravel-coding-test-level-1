@extends('layouts.app')

<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $event->name }}
                    </h5>
                    <p class="mb-3 font-weight-bold text-sm">
                        {{ $event->slug }}
                    </p>
                    <div class="row">
                        <div class="col">
                            <h6>Start at</h6>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $event->start_at }}
                            </p>
                        </div>
                        <div class="col">
                            <h6>End at</h6>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $event->end_at }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 row text-right">
                <div class="col">
                    <a href="{{ route('event.getUpdate', ['event' => $event->id]) }}" type="button"
                        class="btn bg-gradient-secondary font-weight-bold text-sm">
                        Edit
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('event.getDelete', ['event' => $event->id]) }}" type="button"
                        class="btn btn-outline-danger font-weight-bold text-xs">
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-1">Cats</h6>
                <p class="text-sm">Random Cat Gallery</p>
            </div>

            <div class="card-body p-3">
                <div class="row">
                    @foreach ($cats as $cat)
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{ $cat['url'] }}" alt="img-blur-shadow"
                                            class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <p class="text-gradient text-dark mb-2 text-sm">Cat #{{ $cat['id'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

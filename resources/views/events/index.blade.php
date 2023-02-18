@extends('layouts.app')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-10">
                                <h6>Events</h6>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn bg-gradient-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#addEventModal">Add Event</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Start At</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            End At</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>
                                                <a href="{{ route('event.show', ['event' => $event->id]) }}"
                                                    type="button" class="text-secondary font-weight-bold text-xs">
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="../assets/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $event->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $event->slug }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $event->start_at }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $event->end_at }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{ route('event.getUpdate', ['event' => $event->id]) }}"
                                                            type="button"
                                                            class="text-secondary font-weight-bold text-xs">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="{{ route('event.getDelete', ['event' => $event->id]) }}"
                                                            type="button" class="text-danger font-weight-bold text-xs">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
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
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{-- {{ $events->paginate() }} --}}

                    <li class="page-item disabled">
                        <a class="page-link" href="javascript:;" tabindex="-1">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="javascript:;">1</a></li>
                    <li class="page-item active"><a class="page-link" href="javascript:;">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>

<!-- Add Event Modal -->
<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" id="createForm"
    class="need-validation">
    {{ csrf_field() }}
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="start_at" class="form-control-label">Start at</label>
                            <input class="form-control" type="datetime-local" id="start_at" name="start_at">
                        </div>
                        <div class="form-group">
                            <label for="end_at" class="form-control-label">End at</label>
                            <input class="form-control" type="datetime-local" id="end_at" name="end_at">
                        </div>
                        <div class="form-group">
                            <label for="slug" class="form-control-label">Description</label>
                            <textarea class="form-control" id="slug" name="slug"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

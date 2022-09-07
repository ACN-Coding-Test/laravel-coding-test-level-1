@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Event List') }}
                        <div class="float-end"><a href="{{ route('event.create') }}" class="btn btn-success btn-sm">Add
                                Event</a></div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row mb-3">
                            <form action="{{ route('event.index') }}" method="GET" >
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control" placeholder="Search for.. " name="term"
                                        id="term">
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('event.index') }}"  class="btn btn-danger btn-sm">Reset</a>
                                    {{-- <button type="reset" class="btn btn-danger btn-sm">Reset</button> --}}
                                </div>
                            </form>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Event Name') }}</th>
                                    <th>{{ __('Start At') }}</th>
                                    <th>{{ __('End At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td> {{ $event->name }} </td>
                                        <td> {{ $event->start_at }} </td>
                                        <td> {{ $event->end_at }} </td>
                                        <td><a href="{{ route('event.edit', $event->id) }}"
                                                class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                            &nbsp;&nbsp;
                                            <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>{{ $events->links('pagination::bootstrap-4') }}</div>


                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

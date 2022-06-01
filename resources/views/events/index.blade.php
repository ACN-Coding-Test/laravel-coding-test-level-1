@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Events') }}
                <a class="btn btn-sm btn-success" style="float:right;" href="{{ route('events.create') }}">Create</a>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Uuid</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td> {{ $event->id }} </td>
                                    <td> {{ $event->name }} 
                                    @if (Carbon\Carbon::now()->between(Carbon\Carbon::parse($event->startAt), Carbon\Carbon::parse($event->endAt)))
                                        <span class="badge bg-warning">Active</span>
                                    @endif

                                    </td>
                                    <td> {{ \Carbon\Carbon::parse($event->startAt)->format('d-m-Y')}}</td>
                                    <td> {{ \Carbon\Carbon::parse($event->endAt)->format('d-m-Y')}} </td>
                                    <td>
                                        <a href="{{ route('events.edit', $event->id)}}">
                                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="delete">
                                        </form>
                                        <a href="{{ route('events.show', $event->id)}}">
                                            <button type="button" class="btn btn-warning btn-sm">View</button>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">
                                        There are no events.
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

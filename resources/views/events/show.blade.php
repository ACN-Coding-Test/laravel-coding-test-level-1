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
                  

                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Uuid</td>
                                <td> {{ $event->id }} </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td> {{ $event->name }} </td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td> {{ $event->slug }} </td>
                            </tr>
                            <tr>
                                <td>Start At</td>
                                <td> {{ \Carbon\Carbon::parse($event->startAt)->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <td>End At</td>
                                <td> {{ \Carbon\Carbon::parse($event->endAt)->format('d-m-Y')}} </td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td> {{ \Carbon\Carbon::parse($event->createdAt)->format('d-m-Y')}}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

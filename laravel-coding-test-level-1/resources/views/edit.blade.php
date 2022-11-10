@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('message'))
            <div class="col-3 d-flex">
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Event') }}</div>

                <div class="card-body">
                    <form role="form" action="{{ route('events.update', ['event'=>$event->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                             
                            <label for="name">
                                Event Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name"/>
                        </div>
                        <div class="form-group">
                             
                            <label for="startAt">
                                Start
                            </label>
                            <input type="datetime-local" class="form-control" id="startAt" name="startAt"/>
                        </div>
                        <div class="form-group">
                             
                            <label for="endAt">
                                End
                            </label>
                            <input type="datetime-local" class="form-control" id="endAt" name="endAt"/>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

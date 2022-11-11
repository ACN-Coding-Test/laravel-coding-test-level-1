@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Event') }}</div>

                <div class="card-body">
                    <form role="form" action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                             
                            <label for="name">
                                Event Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required/>
                        </div>
                        <div class="form-group">
                             
                            <label for="startAt">
                                Start
                            </label>
                            <input type="datetime-local" class="form-control" id="startAt" name="startAt" required/>
                        </div>
                        <div class="form-group">
                             
                            <label for="endAt">
                                End
                            </label>
                            <input type="datetime-local" class="form-control" id="endAt" name="endAt" required/>
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

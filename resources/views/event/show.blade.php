@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Show Event') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control-plaintext" name="name" value="{{ $event->name }}"  readonly>
    
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="startAt" class="col-md-4 col-form-label text-md-end">{{ __('Start At') }}</label>
    
                                <div class="col-md-6">
                                    <input id="startAt" type="text" class="form-control-plaintext" name="startAt" value="{{ $event->start_at }}" >
                                   
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="endAt" class="col-md-4 col-form-label text-md-end">{{ __('End At ') }}</label>

                                <div class="col-md-6">
                                    <input id="endAt" type="text" class="form-control-plaintext" name="endAt" value="{{ $event->end_at }}" >
                                </div>
                            </div>
    

                    </div>
                    
                </div>

            </div>
        </div>
    </div>
@endsection

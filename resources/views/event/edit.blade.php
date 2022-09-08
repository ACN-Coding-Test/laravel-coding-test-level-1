@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Edit Event') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('event.update', $event->id) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
    
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $event->name }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="startAt" class="col-md-4 col-form-label text-md-end">{{ __('Start At') }}</label>
    
                                <div class="col-md-6">
                                    <input id="startAt" type="datetime-local" class="form-control @error('startAt') is-invalid @enderror" name="startAt" value="{{ $event->start_at }}" required autocomplete="startAt">
    
                                    @error('startAt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="endAt" class="col-md-4 col-form-label text-md-end">{{ __('End At ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="endAt" type="datetime-local" class="form-control @error('endAt') is-invalid @enderror" name="endAt" value="{{ $event->end_at }}" required autocomplete="endAt">
    
                                    @error('endAt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    
                </div>

            </div>
        </div>
    </div>
@endsection

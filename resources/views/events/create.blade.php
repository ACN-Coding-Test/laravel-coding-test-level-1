@extends('layouts.app')

@section('title', 'Create Event')

@push('styles')
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush

@section('content')
	<div class="container">
		<div class="card mt-3">
		  <div class="card-header">
		    Add New Event
		  </div>
		  <div class="card-body">
		    <form method="POST" action="{{url('events')}}">
			@csrf
				<div class="row">
					<div class="col-md-12 form-group mt-2">
						<label for="name" class="form-label">Name</label>
		    			<input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
		    			@if ($errors->has('name'))
		                    <span class="text-danger">{{ $errors->first('name') }}</span>
		                @endif
					</div>

					<div class="col-md-6 form-group mt-2">
						<label for="startDate" class="form-label">Start Date</label>
		    			<input type="date" name="startDate" class="form-control" value="{{ old('startDate') }}" required>
		    			@if ($errors->has('startDate'))
		                    <span class="text-danger">{{ $errors->first('startDate') }}</span>
		                @endif
					</div>

					<div class="col-md-6 form-group mt-2">
						<label for="endDate" class="form-label">End Date</label>
		    			<input type="date" name="endDate" class="form-control" value="{{ old('endDate') }}" required>
		    			@if ($errors->has('endDate'))
		                    <span class="text-danger">{{ $errors->first('endDate') }}</span>
		                @endif
					</div>

					<div class="col-md-6 form-group mt-2">
		    			<label for="startTime" class="form-label mt-2">Start Time</label>
		    			<input type="text" name="startTime" class="form-control timepicker" value="{{ old('startTime') }}" required>
		    			@if ($errors->has('startTime'))
		                    <span class="text-danger">{{ $errors->first('startTime') }}</span>
		                @endif
					</div>

					<div class="col-md-6 form-group mt-2">
		    			<label for="endTime" class="form-label mt-2">End Time</label>
		    			<input type="text" name="endTime" class="form-control timepicker" value="{{ old('endTime') }}" required>
		    			@if ($errors->has('endTime'))
		                    <span class="text-danger">{{ $errors->first('endTime') }}</span>
		                @endif
					</div>
					<div class="col-md-12 mt-2">
						<a href="{{url('events/')}}" class="btn btn-secondary pull-left mt-2">Back</a>
						<input type="submit" class="btn btn-success btn-submit pull-right mt-2" value="Add">
					</div>
				</div>
				
			</form>
		  </div>
		</div>
	</div>
@endsection


@push('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


	<script type="text/javascript">
		const apiUrl = "{{ url('api/v1') }}";
		// $(document).ready(function(){
		// 	$.ajaxSetup({
		//        headers: {
		//            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
		//        }
		//     });
		// });

		$(function () {
			$('input.timepicker').timepicker({
				timeFormat: 'HH:mm:ss'
			});

        });
			
	</script>
@endpush
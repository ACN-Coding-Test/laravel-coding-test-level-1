@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-md-6">
			<a href="{{url('events/create')}}" class="btn btn-success my-2"><i class="fa fa-plus"></i> Event</a>
		</div>
		<div class="col-md-6">
			<form action="{{ url('events') }}">
				<div class="input-group mb-3">
				  <input type="text" name="search" class="form-control" placeholder="Search ID or Name" aria-describedby="button-addon2" value="{{request()->search }}">
				  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
				</div>
			</form>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered mb-1">
			  <thead>
			    <tr class="table-secondary">
			      	<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Slug</th>
					<th scope="col">StartAt</th>
					<th scope="col">EndAt</th>
					<th scope="col">CreatedAt</th>
					<th scope="col">UpdatedAt</th>
					<th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach ($events as $event)
			        <tr>
				      <th scope="row">
				      	<small>{{$event->id}}</small>
				      </th>
				      <td>
				      	<a href="{{url('events/'.$event->id)}}">{{$event->name}}</a>
				      </td>
				      <td>{{$event->slug}}</td>
				      <td>{{$event->startAt}}</td>
				      <td>{{$event->endAt}}</td>
				      <td>{{$event->createdAt}}</td>
				      <td>{{$event->updatedAt}}</td>
				      <td>
				      	<a href="{{url('events/'.$event->id.'/edit')}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>
				      	<a href="#" class="deleteEvent btn btn-danger btn-sm" data-id="{{$event->id}}"><i class="fa fa-trash"></i></a>
				      </td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
			{!! $events->appends(request()->input())->links() !!}
		</div>
	</div>
</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		const apiUrl = "{{ url('api/v1') }}";
		$(document).ready(function(){
			$.ajaxSetup({
		       headers: {
		           'X-CSRF-Token': $('meta[name="_token"]').attr('content')
		       }
		    });
		});

		$(document).on('click','.deleteEvent',function(e){
			e.preventDefault();
	    	let button = $(this),
				id = $(this).data('id');

			if(confirm("Are you sure you want to delete this event?")){
				button.attr('disabled', true);
				$.ajax({
		          type: 'DELETE',
		          url: apiUrl + '/events/'+id+'',
		          success: function(data)
		          {
		          	// console.log(data)
		          	if(data.success) {
		          		location.reload()
		          	}
		          }
		      	});
				
			}
			
		});
			
	</script>
@endpush
@extends('scaffold.basic')
@section('content')
<div class="my-3">
	<h1 class="my-3">Update Event</h1>
	<div class="alert alert-danger d-none" role="alert" id="event-alert"></div>
	<form id="event-form" class="d-none">
		<div class="mb-3">
			<label class="form-label">Event Name</label>
			<input type="text" class="form-control" id="event-name" value="">
		</div>
		<div class="mb-3">
			<label class="form-label">Event Content</label>
			<textarea class="form-control" id="event-content"></textarea>
		</div>
		<div class="mb-3">
			<button type="button" class="btn btn-secondary" id="btn-back">Back</button>
			<button type="button" class="btn btn-primary" id="btn-update">Update</button>
		</div>
	</form>
</div>
<script>
loadEventsData();

document.querySelector('#btn-back').addEventListener('click', function() {
	window.location.href = "http://127.0.0.1:8000/events/";
});
	
function loadEventsData() {
	// Url for the request 
	let url = 'http://127.0.0.1:8000/api/v1/events/{{ $id }}';

	// Making our request 
	fetch(url, { method: 'GET' })
		.then((response) => response.json())
		.then((data) => {
			renderEvent(data);
		})
		.catch((error) => { console.log(error); }
	);
}

function renderEvent(data) {
	if(data !== null) {
		document.querySelector('#event-alert').classList.add('d-none');
		document.querySelector('#event-form').classList.remove('d-none');
		document.querySelector('#event-name').value = data.name;
		document.querySelector('#event-content').value = data.slug;
		// document.querySelector('#start-at').innerText = data.startAt;
		// document.querySelector('#end-at').innerText = data.endAt;
	}
	else {
		document.querySelector('#event-card').classList.add('d-none');
		document.querySelector('#event-alert').classList.remove('d-none');
		document.querySelector('#event-alert').innerText = "Event not found!";
	}
}
</script>
@endsection
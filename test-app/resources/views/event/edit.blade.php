@extends('scaffold.basic')
@section('content')
<div class="my-3">
	<h1 class="my-3">Update Event</h1>
	<div class="alert alert-danger d-none" role="alert" id="event-alert"></div>
	<form id="event-form" class="d-none">
		<div class="mb-3">
			<label class="form-label">Event Name</label>
			<input type="text" class="form-control" id="event-name" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Event Content</label>
			<textarea class="form-control" id="event-content" required></textarea>
		</div>
		<div class="mb-3">
			<label class="form-label">Start At</label>
			<input type="datetime-local" class="form-control" id="event-start-at" required>
		</div>
		<div class="mb-3">
			<label class="form-label">End At</label>
			<input type="datetime-local" class="form-control" id="event-end-at" required>
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

document.querySelector('#btn-update').addEventListener('click', function() {
	if(confirm("Are you sure you want to update this event?")) {
		let eventName = document.querySelector('#event-name').value;
		let eventSlug = document.querySelector('#event-content').value;
		let startAt = document.querySelector('#event-start-at').value;
		let endAt = document.querySelector('#event-end-at').value;

		let jsonData = {
			'name': eventName,
			'slug': eventSlug,
			'startAt': startAt,
			'endAt': endAt,
		}

		// Url for the request 
		const url = 'http://127.0.0.1:8000/api/v1/events/{{ $id }}';
		const requestHeader = {
			method: 'PATCH',
			headers: {
				'Accept': 'application/json',
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(jsonData)
		};

		// Making our request 
		fetch(url, requestHeader)
			.then((response) => response.json())
			.then((data) => {
				if(data.hasOwnProperty('error')) {
					alert(data.error);
				}
				else {
					window.location.href = "http://127.0.0.1:8000/events/{{ $id }}";
				}
			})
			.catch((error) => { console.log(error); }
		);
	}
	
});
	
function loadEventsData() {
	// Url for the request 
	const url = 'http://127.0.0.1:8000/api/v1/events/{{ $id }}';

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
		let startAtFormatted = data.startAt.substring(0, data.startAt.lastIndexOf('.'));
		let endAtFormatted = data.endAt.substring(0, data.endAt.lastIndexOf('.'));
		document.querySelector('#event-alert').classList.add('d-none');
		document.querySelector('#event-form').classList.remove('d-none');
		document.querySelector('#event-name').value = data.name;
		document.querySelector('#event-content').value = data.slug;
		document.querySelector('#event-start-at').value = startAtFormatted;
		document.querySelector('#event-end-at').value = endAtFormatted;
	}
	else {
		document.querySelector('#event-card').classList.add('d-none');
		document.querySelector('#event-alert').classList.remove('d-none');
		document.querySelector('#event-alert').innerText = "Event not found!";
	}
}
</script>
@endsection
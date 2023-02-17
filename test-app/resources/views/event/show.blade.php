@extends('scaffold.basic')
@section('content')
<div class="my-3">
	<div class="alert alert-danger d-none" role="alert" id="event-alert"></div>
	<div class="card d-none" id="event-card">
		<div class="card-body">
			<h5 class="card-title" id="event-name"></h5>
			<h6 class="card-subtitle mb-2 text-muted" id="event-id"></h6>
			<div class="card-text">
				<p id="event-content"></p>
			</div>
		</div>
		<div class="card-footer text-muted">
			<div><strong>Start at: </strong><span id="start-at"></span></div>
			<div><strong>End at: </strong><span id="end-at"></span></div>
		</div>
	</div>
</div>
<script>
loadEventsData();
	
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
	console.log(data);
	if(data !== null) {
		document.querySelector('#event-alert').classList.add('d-none');
		document.querySelector('#event-card').classList.remove('d-none');
		document.querySelector('#event-name').innerText = data.name;
		document.querySelector('#event-id').innerText = data.id;
		document.querySelector('#event-content').innerText = data.slug;
		document.querySelector('#start-at').innerText = data.startAt;
		document.querySelector('#end-at').innerText = data.endAt;
	}
	else {
		document.querySelector('#event-card').classList.add('d-none');
		document.querySelector('#event-alert').classList.remove('d-none');
		document.querySelector('#event-alert').innerText = "Event not found!";
	}
}
</script>
@endsection
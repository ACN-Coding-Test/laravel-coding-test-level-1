@extends('scaffold.basic')
 
@section('content')
<div class="my-3">
	<h1 class="my-3">Event Listing</h1>
	<a href="http://127.0.0.1:8000/events/create" class="btn btn-primary my-3" id="btn-create">Create</a>
	<a href="http://127.0.0.1:8000/cats" class="btn btn-primary my-3" id="btn-create">Something Cute!</a>
	<table class="table" id="event-tbl">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Slug</th>
				<th scope="col">Start At</th>
				<th scope="col">End At</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
<script>
loadEventsData();

function loadEventsData() {
	// Url for the request 
	let url = 'http://127.0.0.1:8000/api/v1/events/';

	// Making our request 
	fetch(url, { method: 'GET' })
		.then((response) => response.json())
		.then((data) => {
			renderEventListing(data);
		})
		.catch((error) => { console.log(error); }
	);
}

function renderEventListing(data) {
	let tbl_row_content = "";
	let row_count = 0;
	for(index in data) {
		++row_count;
		tbl_row_content += "<tr>\
			<td>"+row_count+"</td>\
			<td><a href='http://127.0.0.1:8000/events/"+data[index]['id']+"' target='_blank'>"+data[index]['name']+"</a></td>\
			<td>"+data[index]['slug']+"</td>\
			<td>"+data[index]['startAt']+"</td>\
			<td>"+data[index]['endAt']+"</td>\
			<td>\
				<div class='btn-group'>\
					<button type='button' class='btn btn-primary' data-act='update' data-id='"+data[index]['id']+"'>\<i class='bi bi-pencil'></i></button>\
					<button type='button' class='btn btn-danger' data-act='delete' data-id='"+data[index]['id']+"'><i class='bi bi-trash'></i></button>\
				</div>\
			</td>\
		</tr>";
	}
	document.querySelector('#event-tbl tbody').innerHTML = tbl_row_content;
	bindEventAction()
}

function bindEventAction() {
	let butttons = document.querySelectorAll('#event-tbl tbody button');
	butttons.forEach(btn => {
		btn.addEventListener('click', function(evt) {
			let action = evt.currentTarget.dataset.act;
			let id = evt.currentTarget.dataset.id;
			if(action === 'delete') {
				if(confirm("Are you sure you want to delete this event?")) {
					// Url for the request 
					const url = 'http://127.0.0.1:8000/api/v1/events/'+id;
					const requestHeader = {
						method: 'DELETE',
					};

					// Making our request 
					fetch(url, requestHeader)
						.then((response) => response.json())
						.then((data) => {
							if(data.hasOwnProperty('error')) {
								alert(data.error);
							}
							else {
								loadEventsData();
							}
						})
						.catch((error) => { console.log(error); }
					);
				}
			}
			else if(action === 'update') {
				window.location.href = "http://127.0.0.1:8000/events/"+id+"/edit";
			}
		});
	});
}
</script>
@endsection
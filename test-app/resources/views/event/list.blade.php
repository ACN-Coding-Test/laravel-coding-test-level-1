@extends('scaffold.basic')
 
@section('content')
	<div>
		<h1>Event Listing</h1>
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
		// Url for the request 
		var url = 'http://127.0.0.1:8000/api/v1/events/';
  
		// Making our request 
		fetch(url, { method: 'GET' })
			.then((response) => response.json())
			.then((data) => {
				renderEventListing(data);
			})
			.catch((error) => { console.log(error); }
		);

		function renderEventListing(data) {
			let tbl_row_content = "";
			let row_count = 0;
			for(index in data) {
				++row_count;
				tbl_row_content += "<tr>\
					<td>"+row_count+"</td>\
					<td>"+data[index]['name']+"</td>\
					<td>"+data[index]['slug']+"</td>\
					<td>"+data[index]['startAt']+"</td>\
					<td>"+data[index]['endAt']+"</td>\
					<td>\
						<div class='btn-group'>\
							<button type='button' class='btn btn-primary'>\<i class='bi bi-pencil'></i></button>\
							<button type='button' class='btn btn-danger'><i class='bi bi-trash'></i></button>\
						</div>\
					</td>\
				</tr>";
			}

			document.querySelector('#event-tbl tbody').innerHTML = tbl_row_content;
		}
	</script>
@endsection
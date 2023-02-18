@extends('scaffold.basic')
 
@section('content')
<style>
#photoGrid{
	line-height: 0;
	-webkit-column-count: 3;
	-webkit-column-gap:   0px;
	-moz-column-count:    3;
	-moz-column-gap:      0px;
	column-count:         3;
	column-gap:           0px;  
}

#photoGrid img {
  /* Just in case there are inline attributes */
  width: 100% !important;
  height: auto !important;
}
</style>
<div class="my-3">
	<h1 class="my-3">Meow Meow!</h1>
	<a href="http://127.0.0.1:8000/events/list" class="btn btn-secondary my-3" id="btn-create">Back</a>
	<div id="photoGrid"></div>
</div>
<script>
loadCatsData();

function loadCatsData() {
	// Url for the request 
	let url = 'https://api.thecatapi.com/v1/images/search?limit=20';

	// Making our request 
	fetch(url, { method: 'GET' })
		.then((response) => response.json())
		.then((data) => {
			let imagesData = data;
			imagesData.map(function(imageData) {
				let image = document.createElement('img');
				image.src = imageData.url;
				document.getElementById('photoGrid').appendChild(image);
			});
		})
		.catch((error) => { console.log(error); }
	);
}
</script>
@endsection
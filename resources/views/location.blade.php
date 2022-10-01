@extends('layouts.app')

@section('title', 'Locations')

@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">
			<h2>Locations</h2>
			<div class="input-group mb-3">
			  <input type="text" name="search" class="form-control" placeholder="Search Singapore" id="searchVal">
			  <button class="btn btn-outline-secondary" type="button" id="searchLoc">Search</button>
			</div>
		</div>
		<div class="col-md-12">
			<table id="locations-table" class="table table-bordered mb-1">
			  <thead>
			    <tr class="table-secondary">
			      	<th scope="col">Address</th>
					<th scope="col">Block No</th>
					<th scope="col">Building</th>
					<th scope="col">Postal</th>
					<th scope="col">Road Name</th>
					<th scope="col">Search Value</th>
			    </tr>
			  </thead>
			  <tbody>
			  </tbody>
			</table>
			<nav class="loc-load">
				<div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
				<div>
					<p class="small text-muted">
						Showing
							<span class="fw-semibold start-count"></span>
							to
							<span class="fw-semibold end-count"></span>
							of
							<span class="fw-semibold total-counts"></span>
						results
					</p>
				</div>

				<div>
					<ul class="pagination">
						<li class="page-item prev-link" aria-disabled="true" aria-label="« Previous">
							<a class="page-link" href="#" rel="prev" aria-label="« Previous">‹ Previous</a>
							<span class="page-link" aria-hidden="true" style="display:none">‹ Previous</span>
						</li>
						<li class="page-item next-link">
							<a class="page-link" href="#" rel="next" aria-label="Next »">Next ›</a>
							<span class="page-link" aria-hidden="true" style="display:none">Next ›</span>
						</li>
					</ul>
				</div>
				</div>
			</nav>
		</div>
	</div>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		const oneMapUrl = 'https://developers.onemap.sg/commonapi/search?returnGeom=N&getAddrDetails=Y';

		let	curPage = 1, curSearch = 'Singapore';

		function getData() {
			$('.loc-load').hide()
			let url = oneMapUrl,
				page = curPage,
				search = curSearch;


			url += '&searchVal=' + search
			url += '&pageNum=' + page

			console.log('get')

			const table = $('#locations-table tbody');
			table.html('');

			$('.prev-link').removeClass('disabled')
          	$('.prev-link a').show()
          	$('.prev-link span').hide()

          	$('.next-link').removeClass('disabled')
      		$('.next-link a').show()
      		$('.next-link span').hide()

			$.ajax({
	          type: 'GET',
	          url: url,
	          success: function(data)
	          {
	          	// console.log(data)
	          	$(data.results).each(function(l, location) {
	          		table.append('<tr>' + 
	          			'<td>'+location.ADDRESS+'</td>' +
	          			'<td>'+location.BLK_NO+'</td>' +
	          			'<td>'+location.BUILDING+'</td>' +
	          			'<td>'+location.POSTAL+'</td>' +
	          			'<td>'+location.ROAD_NAME+'</td>' +
	          			'<td>'+location.SEARCHVAL+'</td>' +
	          		'</tr>');
	          	});

	          	if(page == 1) {
	          		$('.prev-link').addClass('disabled')
	          		$('.prev-link a').hide()
	          		$('.prev-link span').show()
	          	}

	          	if(page == data.totalNumPages) {
	          		$('.next-link').addClass('disabled')
	          		$('.next-link a').hide()
	          		$('.next-link span').show()
	          	}

	          	$('.total-counts').html(data.found)
	          	$('.start-count').html(page == 1 ? 1 : ((page - 1) * 10) + 1)
	          	$('.end-count').html(page == 1 ? data.results.length : ((page - 1) * 10) + data.results.length)

	          	if(Number(data.totalNumPages) > 0) {
	          		$('.loc-load').show()
	          	}

		          	
	          }
	      	});
		}

		$(function () {
			getData();
		});

		$(document).on('click','.prev-link a',function(e){
			e.preventDefault();
	    	
	    	curPage--
			getData();
		});

		$(document).on('click','.next-link a',function(e){
			e.preventDefault();
	    	
	    	curPage++
			getData();
		});

		$(document).on('click','#searchLoc',function(e){
			e.preventDefault();
	    	curSearch = $('#searchVal').val();
	    	curPage = 1
			getData();
		});
			
	</script>
@endpush
	@extends('layouts.app')
    
	@section('content')
	<div class="container">
		
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Event List
						<a href="/events/create" class="btn btn-primary btn-sm btn-flat pull-right" id="create"><i class="fa fa-plus"></i>Create</a>
					</div>
					<div class="card-body"> 
						<table id="tbl_list" class="data-table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Slug</th>
									<th>Start</th>
									<th>End</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody> 
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@push('scripts')
	<script type="text/javascript">
	$(document).ready(function () { 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        var table = $('#tbl_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/api/v1/events',
            type: 'GET',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name'},
                { data: 'slug', name: 'slug'},
                { data: 'startAt', name: 'startAt'},
                { data: 'endAt', name: 'endAt'},
                { data: 'action', name: 'action', orderable: false, searchable: false, width: '15	0px'}
            ], 
            
        });

		
    });

	function deleteFunc() {
		var del = confirm('Are you sure?');
		if (del == true) {
			toastr.success("Delete success");
		}
	}

    </script>
    @endpush
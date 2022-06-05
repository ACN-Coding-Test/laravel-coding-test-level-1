<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Events</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</head>

<body>
	<h1>Events Datatable</h1>
	<div class="card">
	    <div class="card-body">
	        <table class="table table-striped yajra-datatable">
	            <thead>
	                <tr>
	                    <th style="width: 5%;">No</th>
	                    <th>Name</th>
	                    <th>Slug</th>
	                    <th>Start At</th>
	                    <th>End At</th>
	                    <th>Created At</th>
	                    <th>Updated At</th>
	                    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody>
	            </tbody>
	        </table>
	    </div>
	</div>
</body>
</html>
<style type="text/css">
	

</style>
<script type="text/javascript">
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: "{{ route('events.get-all-events') }}",
                data: function(d){
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'startAt', name: 'startAt'},
                {data: 'endAt', name: 'endAt'},
                {data: 'createdAt', name: 'createdAt'},
                {data: 'updatedAt', name: 'updatedAt'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            "dom": 'fl<"toolbar">tip'
        });

        $("div.toolbar").css("text-align", "right");
        $("div.toolbar").html('<button id="add-new-event" class="btn btn-primary" style="margin-right:15px"><i class="fas fa-plus"></i> Add New Event</button>');

        $(document).on("click", "button#add-new-event" , function(event) {
            event.preventDefault();
            $(location).attr('href', "/events/create");
        });
        
    });

</script>

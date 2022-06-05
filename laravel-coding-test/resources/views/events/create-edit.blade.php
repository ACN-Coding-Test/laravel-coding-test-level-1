<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Events</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
</head>
<body>
	<h1>Create New Event</h1>
    <form action="{{ $action }}" method="POST" role="form" enctype="multipart/form-data">
		<div class="card-body">
	        <div class="row">
	            <div class="col-lg-6">
	                <div class="form-group">
	                    <label for="name">Name <span style="color:red;">*</span></label>
	                    @if ($type == "edit")
		                    <input type="hidden" class="form-control" id="event_id" name="event_id" value="{{ $event->id }}">
		                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $event->name }}" autocomplete="off">
	                    @else
	                    	<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autocomplete="off" value="">
	                    @endif
	                    <div class="invalid-feedback active">
	                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="slug">Slug <span style="color:red;">*</span></label>
	                    @if ($type == "edit")
	                        <input class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ $event->slug }}"></input>
	                    @else
	                        <input class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug">{{ old('slug') ? old('slug') : '' }}</input>
	                    @endif
	                    <div class="invalid-feedback active">
	                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('slug') <span>{{ $message }}</span> @enderror
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="startAt">Start At <span style="color:red;">*</span></label>
	                    @if ($type == "edit")
	                        <div class="input-group date" id="startdatetimepicker" data-target-input="nearest">
                                <input id="startAt" name="startAt" type="text" class="form-control datetimepicker-input @error('startAt') is-invalid @enderror" value="{{ $event->startAt }}" data-target="#startdatetimepicker">
                                <div class="input-group-append" data-target="#startdatetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text">Calender</div>
                                </div>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('startAt') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
	                    @else
							<div class="input-group date" id="startdatetimepicker" data-target-input="nearest">
                                <input id="startAt" name="startAt" type="text" class="form-control datetimepicker-input @error('startAt') is-invalid @enderror" value="" data-target="#startdatetimepicker">
                                <div class="input-group-append" data-target="#startdatetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text">Calender</div>
                                </div>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('startAt') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>	                    
                        @endif
	                    <div class="invalid-feedback active">
	                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('startAt') <span>{{ $message }}</span> @enderror
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="endAt">End At <span style="color:red;">*</span></label>
	                    @if ($type == "edit")
	                        <div class="input-group date" id="expireddatetimepicker" data-target-input="nearest">
                                <input id="endAt" name="endAt" type="text" class="form-control datetimepicker-input @error('endAt') is-invalid @enderror" value="{{ $event->endAt }}" data-target="#expireddatetimepicker">
                                <div class="input-group-append" data-target="#expireddatetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text">Calender</div>
                                </div>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('endAt') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
	                    @else
	                        <div class="input-group date" id="expireddatetimepicker" data-target-input="nearest">
                                <input id="endAt" name="endAt" type="text" class="form-control datetimepicker-input @error('endAt') is-invalid @enderror" data-target="#expireddatetimepicker">
                                <div class="input-group-append" data-target="#expireddatetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text">Calender</div>
                                </div>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('endAt') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>	  
	                    @endif
	                    <div class="invalid-feedback active">
	                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('endAt') <span>{{ $message }}</span> @enderror
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-12">
	            @if ($type == "edit")
	            <button id="event-update-btn" type="submit" class="btn btn-primary"><i class="far fa-save"></i> Update</button>
	            @else
	            <button id="event-create-btn" type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
	            @endif
	        </div>
	    </div>
	</form>
</body>
</html>
<style type="text/css">
	

</style>
<script type="text/javascript">
    $(document).ready(function() {

        $('#startdatetimepicker').datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss",
        });

        $('#expireddatetimepicker').datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss",
        });

    });
</script>

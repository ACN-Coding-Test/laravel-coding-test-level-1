@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px">

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<fieldset class="border">
<div class="col-12 col-sm-12 col-md-12">
<h2 style="text-align: center;">Edit Event Details</h2>
<form action="{{route('update',$result->id)}}" method="POST" enctype="multipart/form-data">
@csrf	
<div class="row">
	<div class="col-12 col-sm-4 col-md-4 form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control" placeholder="Name" value="{{ $result->name }}">
	</div>

	<div class="col-12 col-sm-4 col-md-4 form-group">
		<label>Slug</label>
		<input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ $result->slug }}">
	</div>

	<div class="col-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">Submit</button >
	</div>
</div>
</form>
</div>
</fieldset>
</div>	

@endsection


<style>
.border{
    border: 1px solid silver !important;
    margin: 0 2px;
    padding: 10px 0 0 0;
}	
</style>	
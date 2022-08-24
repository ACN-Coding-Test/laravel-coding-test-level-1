@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px">

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<div class="row" style="margin-bottom:10px">
<form action="{{route('index')}}" method="GET" class="commonform" id="searchform">  
<div class="col-12 col-sm-3 col-md-3">
<input type="text" name="search" class="form-control" placeholder="Enter Name" value="{{request()->get('search','')}}">
</div>  

<div class="col-12 col-sm-3 col-md-1">
<button type="submit" class="btn btn-primary gradientbutton" id="search">Search</button>  
</div>  

<div class="col-12 col-sm-3 col-md-8">
<a href="{{route('create')}}" class="btn btn-primary pull-right">Add Event</a>
</div>  
</form>
</div>

<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
  <th>#</th>
  <th>Name</th>
  <th>Slug</th>
  <th>Created At</th>
  <th>Updated At</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
@if(!empty($results))
@foreach($results as $key=>$result)	
<tr>
  <th scope="row">{{$result->id}}</th>
  <td>{{$result->name}}</td>
  <td>{{$result->slug}}</td>
  <td>{{$result->created_at}}</td>
  <td>{{$result->updated_at}}</td>
  <td>
    <a href="{{route('edit',$result->id)}}"><span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit" ></span></a>
    <a href="{{route('destroy',$result->id)}}"><span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete" ></span></a>
  </td>
</tr>
@endforeach
@endif 
</tbody>
</table>

{{ $results->links() }}
</div>
</div>

@endsection
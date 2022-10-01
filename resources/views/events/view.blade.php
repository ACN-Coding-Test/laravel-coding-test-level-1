@extends('layouts.app')
    
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page" ><strong>View Event</strong></li>
        </ol>
        </nav>
        
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" disabled name="name" value="{{$events->name}}" id="name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="Slug">Slug</label>
                    <input type="text" class="form-control" disabled name="slug" value="{{$events->slug}}" id="slug" placeholder="Slug">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="Start">Start Date</label>
                    <input type="date" class="form-control" disabled name="startAt" value="{{$events->startAt}}" id="start" placeholder="Start Date">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="End">End Date</label>
                    <input type="date" class="form-control" disabled name="endAt" value="{{$events->endAt}}" id="end" placeholder="End Date">
                    </div>
                </div>

                <a href="/events" class="btn btn-light">Back</a>
            </form>
       
		</div>
	</div>
</div>
@endsection
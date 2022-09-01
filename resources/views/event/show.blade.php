@extends('layouts.admin.app')
@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li>Events</li>
            <li class="active">Details</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Events</h1>
        </div>
    </div><!--/.row-->
    
    
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="pull-left">Event Details</div>
                <div class="pull-right">
                    <a href="{{ url('/events') }}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-arrow-circle-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>
              <div class="clearfix"></div>
            </div>
          
            <div class="section">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table" >
                           <thead>
                                <tr>
                                    <th scope="col">Field</th>
                                    <th scope="col">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <th scope="row">Name</th>
                                  <td scope="col">{{$event->name}}</td>
                                </tr>
                                <tr>
                                  <th scope="row">Slug</th>
                                  <td scope="col">{{$event->slug}}</td>
                                </tr>
                                <tr>
                                  <th scope="row">Created At</th>
                                  <td scope="col">{{date('d M-Y H:i:s',strtotime($event->createdAt))}}</td>
                                </tr>
                                <tr>  
                                  <th scope="row">Updated At</th>
                                  <td scope="col">{{date('d M-Y H:i:s',strtotime($event->updatedAt))}}</td>
                                </tr>
                            </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            
            </div>
        </div>
    </div><!--/.row-->
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection

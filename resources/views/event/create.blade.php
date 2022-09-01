@extends('layouts.admin.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-calendar"></em>
            </a></li>
            <li class="">Event</li>
            <li class="active">Add</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Event</h1>
        </div>
    </div><!--/.row-->
    
    
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom: 20px;">
                <div class="pull-left">Add Form</div>
                <div class="pull-right" style="margin-right: 40px;">
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
                  <div class="col-lg-10">
                    <form class="form-horizontal" method="post" action="{{url('/events/store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="text" placeholder="{{ __('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" autocomplete="name" autofocus type="text" placeholder="{{ __('slug optional') }}">
                            </div>
                        </div>
                        <div class="form-group margin-bottom-0">
                            <div class="col-sm-offset-2 col-sm-5">
                                <button type="submit" class="btn btn-primary btn-icon-split">                                        
                                    <span class="icon text-white-50">
                                        <i class="fa fa-save"></i>
                                    </span>
                                    <span class="text">Save</span>
                                </button>

                                <a href="{{ url('/events') }}" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-arrow-circle-left"></i>
                                    </span>
                                    <span class="text">Cancel</span>
                                </a>
                            </div>                                
                        </div>
                    </form>

                  </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>

@endsection
@section('css')
    
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection
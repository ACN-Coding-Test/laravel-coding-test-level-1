@extends('layouts.admin.app')
@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Events</li>
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
              <div class="pull-left">Event List</div>
              <div class="pull-right">
                  <form action="" method="" class="form-inline pull-right" id="searchForm">
                    <div class="form-row">
                        <div class="form-group p-1">
                            <input type='text' class="form-control" name="keyword" value="<?php echo $keyword; ?>" placeholder="Title" />
                        </div>
                        <div class="form-group p-1">              
                            <a href="javascript:;" onclick="$('#searchForm').submit();" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-search"></i>
                                </span>
                                <span class="text">Search</span>
                            </a>
                        </div>
                        <div class="form-group p-1">
                            <a href="{{ url('events/create') }}" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus-circle"></i>
                                </span>
                                <span class="text">Add Event</span>
                            </a>
                        </div>
                    </div>
                  </form>
                </div>
              <div class="clearfix"></div>
            </div>
            
              
          
            <div class="section">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table" >
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Slug</th>
                              <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($events as $index=>$event){ ?>
                            <tr>
                                <th scope="row"><?php echo $index+1; ?></th>
                                <td>
                                    <a title="View" href="{{ url('events/show/'.$event->id)}}">
                                        <?php echo $event->name; ?>
                                    </a>
                                </td>
                                <td><?php echo $event->slug; ?></td>
                                <td>
                                    <form class="form-inline" id="form_<?php echo $event->id?>" action="{{ url('events/delete/'.$event->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a title="Edit" href="{{ url('events/edit/'.$event->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;

                                        <button type="submit" class="btn btn-link">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    
                                </td>
                            </tr>
                            <?php } ?>                                
                        </tbody>
                      </table>
                      <div style="padding-left: 20px;" class="d-flex justify-content-center">
                        {!! $events->links() !!}
                      </div>
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
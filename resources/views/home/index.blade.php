@extends('layouts.admin.app')
@section('content')
<style type="text/css">
.paging-nav {
  text-align: right;
  padding-top: 20px;
  padding-bottom: 20px;
  text-align: center;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

.paging-nav,
#tableData {
  margin: 0 auto;
  font-family: Arial, sans-serif;
}
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Home</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Home - Free Apis</h1>
        </div>
    </div><!--/.row-->
    
    
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="pull-left">Free Api List</div>
              <div class="clearfix"></div>
            </div>
            
            <div class="section">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="tableData">
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Api</th>
                              <th scope="col">Description</th>
                              <th scope="col">Auth</th>
                              <th scope="col">HTTPS</th>
                              <th scope="col">Cors</th>
                              <th scope="col">Link</th>
                              <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($apiList->entries as $index=>$api){ ?>
                            <tr>
                                <th scope="row"><?php echo $index+1; ?></th>
                                <td><?php echo $api->API; ?></td>
                                <td><?php echo $api->Description; ?></td>
                                <td><?php echo $api->Auth; ?></td>
                                <td><?php echo $api->HTTPS; ?></td>
                                <td><?php echo $api->Cors; ?></td>
                                <td><?php echo $api->Link; ?></td>
                                <td><?php echo $api->Category; ?></td>
                            </tr>
                            <?php } ?>                                
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
@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="{!! asset('plugin/pagining/paging.js')!!}" ></script> 
<script type="text/javascript">
    $('document').ready(function(){
        $('#tableData').paging({limit: 100});
    });
</script>
@endsection
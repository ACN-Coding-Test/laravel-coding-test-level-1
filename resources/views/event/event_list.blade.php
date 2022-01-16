@extends('layout')
@section('content')    
    <div class="row">
      <div class="col-md-3">
        <h2><?=($search=='1') ? 'Search' : 'All'?> Events</h2>                
      </div>
      <div class="col-md-4">
        <form id="event_search_form" action="<?=route('search_event_web')?>" method="post">
          <div class="input-group">
            <input type="text" id="event_search_val" name="event_search_val" class="form-control" placeholder="ID, Event name, or Slug...">
            <span class="input-group-btn">
              @csrf
              <?php
              if($search=='1'){
              ?>
              <a href="<?=route('event_list_web')?>">
                <button id="event_search_reset" class="btn btn-primary form-control" type="button" alt="Search Reset" title="Search Reset"><i class="fa fa-refresh"></i></button>
              </a>
              <?php
              }else{
              ?>
              <button id="event_search" class="btn btn-primary form-control" type="submit" alt="Search" title="Search"><i class="fa fa-search"></i></button>                          
              <?php
              }
              ?>
            </span>
          </div>
        </form>
      </div>  
      <div class="col-md-5 text-right">
        <a href="<?=route('event_create_web')?>">
          <button class="btn btn-primary" type="button" alt="Create Event" title="Create Event"><i class="fa fa-plus"></i> Create Event</button>
        </a>       
      </div>     
    </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($events)>'0'){
            foreach($events as $event){
            ?>
            <tr>
              <td><?=$event->id?></td>
              <td><?=$event->name?></td>
              <td><?=$event->slug?></td>
              <td><?=$event->createdAt?></td>
              <td>
                <a href="<?=route('event_show_web', ['id' => $event->id])?>/edit"><span class="badge badge-primary" role="button">Edit</span></a>
                <span class="badge badge-danger" role="button" Onclick="delete_event('<?=$event->id?>');" >Delete</span>
              </td>
            </tr>
            <?php
            }
          }else{
          ?>
           <tr class="text-center">
              <td colspan="5">There is no events.</td>              
            </tr>
          <?php
          }
          ?>          
        </tbody>
      </table>
      <div class="d-felx justify-content-center">            
          <?=$events->links()?>
      </div>
@endsection

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.0.0/sweetalert.min.js" integrity="sha512-zwZQtJZnpG982ihGzVT53UY+yTFtT66spX5HOiYmKFeO1unLJ7NJdprbWOHKAhHdKSDwNKbBgCubsrvGJaAehQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function delete_event(id){
    var _token          =   $('meta[name="csrf-token"]').attr('content');
    swal({
      title: "Are you sure?",
      text: "Event may deleted!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if(willDelete) {
        $.ajax({
            url: "<?=route('delete_event_web')?>",
            method: 'post',
            data: {
                event_id  :   id,
                _token    :   _token,
            },
            cache: false,
            success: function(response) {          
                if(response.success==true){     
                  swal({
                      title: "Deleted",
                      text: "Event deleted successfully.",
                      icon: "success",
                      timer: 2000,
                      buttons: false
                  }); 
                  setTimeout(function(){ 
                      window.location= ('<?=route('event_list_web')?>');                                
                  }, 2000);                      
                }
            }
        });         
      }
    });
  }
  
  $(document).ready(function() { 
    $("#event_search_form").submit(function(e){
        e.preventDefault();
    });
    $("#event_search_form").validate({
        errorElement: "div",
        errorClass: "form-error-block",
        rules: {
            'event_search_val': {
                required: true,                
            },       
        },
        messages: {
            'event_search_val': {
                required: "",
            },                         
        },
        submitHandler: function(form) {      
          $('#event_search_form')[0].submit();
        }
    });
  });
</script>



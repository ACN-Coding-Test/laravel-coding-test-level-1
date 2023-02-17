@extends('layout')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Event</div>
                <form id="edit_event_form" action="" method="post">
                    <div class="card-body"> 
                        <div class="row mb-3 form-group">
                            <label for="name" class="col-md-2 col-form-label">Event Name</label>
                            <div class="col-md-10">
                                <input type="text" name="event_name" class="form-control" value="<?=$event->name?>" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="slug" class="col-md-2 col-form-label">Slug</label>
                            <div class="col-md-10">
                                <input type="text" name="event_slug" class="form-control" value="<?=$event->slug?>" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="slug" class="col-md-2 col-form-label">Created At</label>
                            <div class="col-md-10">
                                <input type="text" readonly class="form-control" value="<?=date('d/m/Y h:i:s A', strtotime($event->createdAt))?>" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="slug" class="col-md-2 col-form-label">Updated At</label>
                            <div class="col-md-10">
                                <input type="text" readonly class="form-control" value="<?=date('d/m/Y h:i:s A', strtotime($event->updatedAt))?>" />
                            </div>
                        </div>
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-10 offset-md-2">
                                <a href="<?=route('event_list_web')?>" class="btn btn-info">Cancel</a>
                                <button type="submit" class="btn btn-success float-right">Update</button>
                                <input type="hidden" name="event_id_hidden" id="event_id_hidden" value="<?=$event->id?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.0.0/sweetalert.min.js" integrity="sha512-zwZQtJZnpG982ihGzVT53UY+yTFtT66spX5HOiYmKFeO1unLJ7NJdprbWOHKAhHdKSDwNKbBgCubsrvGJaAehQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$("#edit_event_form").submit(function(e){
    e.preventDefault();
});
$(document).ready(function() { 
    $("#edit_event_form").validate({
        errorElement: "div",
        errorClass: "form-error-block",
        rules: {
            'event_name': {
                required: true,
                minlength: 5,
                maxlength: 120,
                remote: {
                    url: "<?=route('event_name_exist')?>",
                    type: "post",
                    data: {
                    "_token"    : "{{ csrf_token() }}",
                    "event_id": function() { return $('#event_id_hidden').val(); },
                    }
                }
            },  
            'event_slug': {
                required: true,
                minlength: 5,
                maxlength: 120,
                remote: {
                    url: "<?=route('event_name_exist')?>",
                    type: "post",
                    data: {
                    "_token"    : "{{ csrf_token() }}",
                    "event_id": function() { return $('#event_id_hidden').val(); },
                    }
                }
            },           
        },
        messages: {
            'event_name': {
                required: "Please enter the event name",
                remote: "Event name already in exist",
            }, 
            'event_slug': {
                required: "Please enter the event slug",
                remote: "Event slug already in exist",
            },             
        },
        submitHandler: function(form) {      
            var formID          =   $('#edit_event_form')[0];
            var formData        =   new FormData(formID);
            $.ajax({
                url: "<?=route('update_event', ['id' => $event->id])?>",
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,                
                success: function(response) {  
                    if(response.success==true){
                        swal({
                            title: 'Event Updated',
                            text: 'Event updated successfully.',
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                            showConfirmButton: false,
                            showCloseButton: false,
                        });
                        setTimeout(function(){ 
                            window.location= ('<?=route('event_list_web')?>');                                
                        }, 2000);
                    }
                }
            });
        }
    });

});

</script>
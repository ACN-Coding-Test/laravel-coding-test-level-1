@extends('layout')
@section('content')

<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Event</div>
                <form id="create_event_form" action="" method="post">
                    <div class="card-body"> 
                        <div class="row mb-3 form-group">
                            <label for="name" class="col-md-2 col-form-label">Event Name</label>
                            <div class="col-md-10">
                                <input type="text" name="event_name" class="form-control" value="" />
                            </div>
                        </div>                        
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-10 offset-md-2">
                                <a href="<?=route('event_list_web')?>" class="btn btn-info">Cancel</a>
                                <button type="submit" class="btn btn-success float-right">Submit</button>
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
    $("#create_event_form").validate({
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
                    }
                }
            },       
        },
        messages: {
            'event_name': {
                required: "Please enter the event name",
                remote: "Event name already in exist",
            },                         
        },
        submitHandler: function(form) {      
            var formID          =   $('#create_event_form')[0];
            var formData        =   new FormData(formID);
            $.ajax({
                url: "<?=route('event_store')?>",
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,                
                success: function(response) {  
                    if(response.success==true){
                        swal({
                            title: 'Event Created',
                            text: 'Event created successfully.',
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
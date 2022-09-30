<html>
    <head>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    </head>
    <body> <br/>
    <h2>Add Event</h2>
    <div class="form-group row add" style="width:50%">
    <input type="hidden" class="form-control" id="_token" name="_token" value="{{ csrf_token() }}"/>
            <div class="col-md-8">
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="Name" required>
                <p class="error text-center alert alert-danger hidden"></p>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" id="slug" name="slug"
                    placeholder="Slug" required>
                <p class="error text-center alert alert-danger hidden"></p>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span> ADD
                </button>
            </div>
        </div>
        <br/>
        <table class="table" id="eventsTable">
            <thead>
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Date Created</th>
                    <th class="text-center">Date Updated</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($events as $item)
                <tr class="item{{$item->id}}">
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->slug}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>{{$item->created_at}}</td>
                    <td><button class="edit-modal btn btn-info" data-id="{{$item->id}}" data-name="{{$item->name}}" data-slug="{{$item->slug}}">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal btn btn-danger"
                        data-id="{{$item->id}}" data-name="{{$item->name}}" data-slug="{{$item->slug}}">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="myModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
  			<!-- Modal content-->
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal">&times;</button>
  					<h4 class="modal-title"></h4>
  				</div>
  				<div class="modal-body">
  					<form class="form-horizontal" role="form">
                      <div class="form-group">
  							<label class="control-label col-sm-2" for="id">ID:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="id" disabled>
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="name">Name:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="eventname"/>
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="name">Slug:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="eventslug"/>
  							</div>
  						</div>
  					</form>
  					<div class="deleteContent">
  						Are you Sure you want to delete <span class="dname"></span> ? <span
  							class="hidden did"></span>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
  							<span id="footer_action_button" class='glyphicon'> </span>
  						</button>
  						<button type="button" class="btn btn-warning" data-dismiss="modal">
  							<span class='glyphicon glyphicon-remove'></span> Close
  						</button>
  					</div>
  				</div>
  			</div>
		  </div>


    </body>
</html>

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    $(document).ready(function() {
        $('#eventsTable').DataTable();
       
        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text("Update");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Edit');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#id').val($(this).data('id'));
            $('#eventname').val($(this).data('name'));
            $('#eventslug').val($(this).data('slug'));
            $('#myModal').modal('show');
        });
        $(document).on('click', '.delete-modal', function() {
            $('#footer_action_button').text(" Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Delete');
            $('.did').text($(this).data('id'));
            $('.deleteContent').show();
            $('.form-horizontal').hide();
            $('.dname').html($(this).data('name'));
            $('#myModal').modal('show');
        });
   
    $("#add").click(function() {
        $.ajax({
                type: 'post',
                url: APP_URL + '/events/create',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': $('input[name=name]').val(),
                    'slug': $('input[name=slug]').val()
                },
                success: function(data) {
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } else {
                        $('.error').remove();
                        $('#eventsTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td>" + "<td>" + data.slug + "</td><td></td><td></td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "' data-slug='" + data.slug + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }
                },
         });
        $('#name').val('');
    });

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'put',
            url: APP_URL + '/events/' + $("#id").val() + '/edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#eventname').val(),
                'slug': $('#eventslug').val(),
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                   
                } else {
                     $('.error').addClass('hidden');
                     $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td>" + "<td>" + data.slug + "</td><td></td><td></td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "' data-slug='" + data.slug + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }}
            });
    });

    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'delete',
            url: APP_URL + '/events/' + $("#id").val() + '/delete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
});

 </script>
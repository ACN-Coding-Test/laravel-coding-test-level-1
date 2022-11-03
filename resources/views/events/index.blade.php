@extends('layouts.app')

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')

    @if(isset($errors) && $errors->has('message'))
        <div class="alert alert-danger" role="alert">
            <b>Error:</b> {{ $errors->first('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>Events</h2>
        <a href="/events/create" class="btn btn-lg btn-outline-primary">Create Event</a>
    </div>

    <div class="card p-3">
        <table id="tbl_events" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th width="100px">Action</th>
            </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
        $(function () {
            var table = $('#tbl_events').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/datatables/events",
                order: [1,'asc'],
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'show', name: 'show'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $(document).on('click','.delete_event', function () {
                var rowData = table.row($(this).parents('tr')).data();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ env('API_URL') . "/events/" }}"+rowData['id'],
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                                "Authorization": "Bearer {{ $session_id }}"
                            },
                            success: function(data){
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Event Successfully Deleted',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        table.ajax.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Event Not Deleted',
                                        confirmButtonText: 'Ok'
                                    });
                                }
                            },
                            error: function (data) {
                                var json = JSON.parse(data.responseText);

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    html: json.message,
                                }).then((result) => {
                                    window.location.href = '/';
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="col-md-8">

        <ul id="errors"></ul>

        <div id="success_message"></div>

        <div class="card">
            <div class="card-header">Update Event</div>
            <div class="card-body">
                <form action="#" method="POST">
                    {!! csrf_field() !!}
                    <div class="row">
                            <label for="name">* Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="row" style="padding-top: 1vw">
                            <label for="slug">* Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-1">
                            <input type="submit" value="update" class="btn btn-success btn-sm" id="update_event"><br>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <hr>
        <a href="/events" class="btn btn-info">Back</a>
    </div>
@stop

@section('scripts')
    <script type=text/javascript>
        $(document).ready(function () {
            const url = window.location.pathname;
            const parts_of_url = url.split('/');

            fetchSingleEvent();

            function fetchSingleEvent() {

                $.ajax({
                    type: "GET",
                    url: 'http://127.0.0.1:8000/api/v1/events/' + parts_of_url[2],
                    dataType: "json",
                    success: function (response) {
                        $('#name').val(response.data.name);
                        $('#slug').val(response.data.slug);
                    }
                });
            }

            $(document).on('click', '#update_event', function (e) {
                e.preventDefault();

                $(this).text('Sending..');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const data = {
                    'name': $('#name').val(),
                    'slug': $('#slug').val(),
                }

                $.ajax({
                    type: "PUT",
                    url: '/api/v1/events/' + parts_of_url[2],
                    data: data,
                    dataType: "json",
                    success: function () {
                        $('#errors').html("").removeClass('alert alert-danger');
                        $('#success_message').addClass('alert alert-success').text('successfully updated');
                        $('.add_event').text('Save');
                    },
                    error: function (error) {
                        $('#errors').html("").addClass('alert alert-danger');
                        $.each(error.responseJSON.errors, function (key, err_value) {
                            $('#errors').append('<li>' + err_value[0] + '</li>');
                        });
                        $('.add_event').text('Save');
                    }
                });

            });


        });
    </script>
@stop
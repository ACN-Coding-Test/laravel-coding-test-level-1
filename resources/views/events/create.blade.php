@extends('layouts.app')

@section('content')
            <div class="col-md-8">

                <ul id="errors"></ul>

                <div id="success_message"></div>

                <div class="card">
                    <div class="card-header">Create Event</div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            {!! csrf_field() !!}
                            <div class="row">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="row" style="padding-top: 1vw">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" required>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-1">
                                    <input type="submit" value="Save" class="btn btn-success" id="add_event"><br>
                                </div>
                                <div class="col-md-1">
                                    <input type="reset" value="Clear" class="btn btn-danger" id="reset_event">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <a href="/events" class="btn btn-info">Back</a>
            </div>
@endsection

@section('scripts')
    <script type=text/javascript>
        $(document).ready(function () {
            $(document).on('click', '#add_event', function (e) {
                e.preventDefault();

                $(this).text('Sending..');

                const data = {
                    'name': $('#name').val(),
                    'slug': $('#slug').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/api/v1/events",
                    data: data,
                    dataType: "json",
                    success: function () {
                        $('#errors').html("").removeClass('alert alert-danger');
                        $('#success_message').addClass('alert alert-success').text('successfully created!');
                        $('.add_event').text('Save');

                        window.location.href = '/events';
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


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-8">

                <div class="">
                    <label for="search"></label><input type="text" id="search" placeholder="search by name or slug">
                </div>

                <div id="success_message"></div>

                <table class="table table-hover" id="events_table">
                    <thead>
                    <tr>
                        <th>Id:</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th colspan='2'>Action</th>
                    </tr>

                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination"></ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type=text/javascript>
        $(document).ready(function () {
            fetchEvents();

            function fetchEvents(given_url = '', search = '') {
                let url = given_url ? given_url: '/api/v1/events';
                let data = {};

                let val = $.trim($('#search').val());
                if (val) {
                    val = val.toLowerCase();
                    data = {
                        search: val
                    }
                }

                $.ajax({
                    type: "GET",
                    url: url,
                    data,
                    dataType: "json",
                    success: function (response) {
                        console.log(data, url);
                        console.log(response.data.data);
                        $('tbody').html("");
                        if (response.data.data.length) {
                            $.each(response.data.data, function (key, item) {
                                $('tbody').append('<tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + item.slug + '</td>\
                            <td>' + item.createdAt + '</td>\
                            <td>' + item.updatedAt + '</td>\
                            <td><a target="_blank" href="/events/' + item.id + '/edit" class="btn btn-primary editbtn btn-sm">Edit</a></td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-danger delete_button btn-sm">Delete</button></td>\
                        \</tr>');
                            });

                            $('.pagination').html('');
                            $.each(response.data.links, function (key, item) {
                                let active = '';
                                if(item.active){
                                    active = 'active';
                                }
                                $('.pagination').append('<li class="page-item"><a class="page-link '+ active +'" href="#" data-url="' + item.url + '">'+item.label+'</a></li>');
                            });
                        } else {
                            $('#events_table').html("No events Found");
                        }
                    }
                });
            }

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                fetchEvents($(this).data("url"));
            })

            $(document).on('click', '.delete_button', function () {
                const event_id = $(this).val();
                if (confirm('Do want to delete this event?')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        url: "/api/v1/events/" + event_id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status === 404) {
                                $('#success_message').addClass('alert alert-success').text(response.message);
                                $('.delete_button').text('Yes Delete');
                            } else {
                                $('#success_message').html("").addClass('alert alert-success').text('Successfully deleted event!');
                                $('.delete_button').text('Yes Delete');

                                fetchEvents();
                            }
                        }
                    });
                }
            });

            $(document).on('keyup', '#search', function() {
                $("tbody").html("");
                fetchEvents();
            });

        });

    </script>
@stop

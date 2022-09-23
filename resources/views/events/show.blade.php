@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header" id="event_title"></div>
        <div class="card-body" id="event_details"></div>
    </div>
@stop

@section('scripts')
    <script type=text/javascript>
        $(document).ready(function () {
            fetchSingleEvent();

            function fetchSingleEvent() {
                const url = window.location.pathname;
                const id = url.substring(url.lastIndexOf('/') + 1);
                $.ajax({
                    type: "GET",
                    url: '/api/v1/events/'+id,
                    dataType: "json",
                    success: function (response) {
                        $('#event_title').append('<p>\
                            <p class="card-title">' + response.data.name + '</div>\
                        \</p>');

                            $('#event_details').append('<p>\
                            <p class="card-text">ID:     ' + response.data.id + '</p>\
                            <p class="card-text">Name:   ' + response.data.name + '</div>\
                            <p class="card-text">Slug:   ' + response.data.slug + '</div>\
                        \</p>');
                    }
                });
            }
        });
    </script>
@stop
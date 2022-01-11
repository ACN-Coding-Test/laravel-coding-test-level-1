@extends('layouts.app')

@section('content')
<style type="text/css">
.flex.flex-1 { margin-top: 10px; margin-bottom: 16px; }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h4>Remote data</h4>
            <table class="table table-bordered" id="remote-data">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created at</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> 
    </div>
</div>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost:8000/api/v1/events',
            dataType: 'json',
            success:function(jsonResult) {
                for (var i = 0; i < jsonResult.length; i++) {
                    $('#remote-data > tbody').append(
                        '<tr>' +
                            '<td>' + jsonResult[i].name + '</td>' +
                            '<td>' + jsonResult[i].slug + '</td>' +
                            '<td>' + formatDate(jsonResult[i].createdAt) + '</td>' +
                            '<td>' + formatDate(jsonResult[i].updatedAt) + '</td>' +
                        '</tr>'
                    );
                }
            }
        });
    });

    /* $.getJSON('http://localhost:8000/api/v1/events', (data) => {
        for (var i = 0; i < data.length; i++) {
            $('#remote-data > tbody').append(
                '<tr>' +
                    '<td>' + data[i].name + '</td>' +
                    '<td>' + data[i].slug + '</td>' +
                    '<td>' + data[i].createdAt + '</td>' +
                    '<td>' + data[i].updatedAt + '</td>' +
                '</tr>'
            );
        }
    }); */

    function formatDate($date)
    {
        var date = Date.parse($date);
        date = new Date(date);

        var day = ('0' + date.getDate()).slice(-2);
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var year = date.getFullYear();
        var hour = date.getHours();
        var minute = date.getMinutes();
        var second = date.getSeconds();
        var ampm = (hour >= 12 ? 'pm' : 'am');
        if (hour > 12) hour = hour - 12;
        if (hour == 0) hour = 12;

        return addZero(day) + '/' + addZero(month) + '/' + year + ' ' + addZero(hour) + ':' + addZero(minute) + ':' + addZero(second) + ' ' + ampm;
    }

    function addZero(i) {
        if (i < 10) {i = "0" + i}
        return i;
    }


</script>
@endsection

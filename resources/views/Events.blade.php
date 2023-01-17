<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        @livewireStyles
    </head>
    <body>
        @if( $event_list )
        <table id="events-table">
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Slug</td>
                <td>Start At</td>
                <td>End At</td>
                <td>Created At</td>
                <td>Updated At</td>
                <td>Deleted At</td>
            </tr>
        @foreach($event_list as $event)
            <tr>
            @foreach($event as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
            <td><button>Update</button></td>
            <td><button id="delete-btn">Delete</button></td>
            </tr>
        @endforeach
        </table>
        @endif
        <script>
            $(document).ready(function() {

                $("#events-table").on('click','#delete-btn',function() {
                
                    var currentRow=$(this).closest("tr");
                    var col1=currentRow.find("td:eq(0)").text();

                    let response = fetch('http://127.0.0.1:8000/api/v1/events/' + col1, {
                        method: 'DELETE',
                        //body: formData
                        }).then(response => response.json());
                    
                    if( response ) {

                        location.reload();
                    }
                });
            });
        </script>
    </body>
    </html>
<!DOCTYPE html>
<html>
    <head>
        @livewireStyles
    </head>
    <body>
        <table>
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
            <td><button>Delete</button></td>
            </tr>
        @endforeach
        </table>
    </body>
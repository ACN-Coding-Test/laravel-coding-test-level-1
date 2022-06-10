
@php
$results->appends(request()->input())
@endphp
@extends('master')


@section('content')



    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    2-ui-get
                </h1>
                <a href="{{route('events.create')}}">CREATE</a>

                <form method="GET" action="{{request()->fullUrl()}}">
                    <div class="form-group mt-3">

                        <label for="exampleInputEmail1">Search</label>
                        <input type="text" class="form-control" id="#tesxt"
                               aria-describedby="emailHelp"
                               name="name"
                               value="{{request()->get('name')}}"

                               placeholder="Search by name">
                        <input type="submit" class="btn btn-success mt-3" value="Search" />
                    </div>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>slug</th>
                        <th>start at</th>
                        <th>end at</th>
                        <th>Action</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($results as $data)
                        <tr>

                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->slug}}</td>
                            <td>{{$data->startAt}}</td>
                            <td>{{$data->endAt}}</td>

                            <td><a href="{{route('events.edit',['id'=>$data->id])}}">Edit</a><br/><a href="#" onclick="deleteRow({{$data->id}})">Delete</a></td>

                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <nav aria-label='Page navigation example'>
        <ul class='pagination justify-content-center'>
            <li class='page-item'>
                <a class='page-link' href='{{$results->url(1)}}' tabindex='-1' aria-disabled='true'>First</a>
            </li>
            <li class='page-item'>
                <a class='page-link' href='{{$results->url($results->currentPage()-1)}}' tabindex='-1' aria-disabled='true'><<</a>
            </li>






            <li class='page-item'>
                <a class='page-link' href='{{$results->url($results->currentPage()+1)}}'>>></a>
            </li>
            <li class='page-item'>
                <a class='page-link' href='{{$results->url($results->lastPage())}}'>Last</a>
            </li>
        </ul>
    </nav>

@endsection

<script>
    function deleteRow(id){
        if(confirm("Are you sure to delete?")){
                $.ajax({
                    type: "POST",
                    data: {_method:'delete'},
                    url: '{{env("APP_URL")}}api/v1/events/'+id,
                    success: function(data)
                    {
                        alert(data.message)
                        location.reload()
                    },
                    error: function(data){
                        alert("Delete Error")
                    }
                });
        }

    }
</script>
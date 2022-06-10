@extends('master')


@section('content')



    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    2-ui-get
                </h1>
                <a href="{{route('events.create')}}">CREATE</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th>edit</th>
                        <th>id</th>
                        <th>name</th>
                        <th>slug</th>
                        <th>start at</th>
                        <th>end at</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($results as $data)
                        <tr>

                            <td><a href="{{route('events.edit',['id'=>$data->id])}}">Edit</a></td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->slug}}</td>
                            <td>{{$data->startAt}}</td>
                            <td>{{$data->endAt}}</td>
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
@extends('layouts.app')

@section('content')
<style>
    .post-card:hover {
        background-color: #0d6efd;
        color: white;
        cursor: pointer;
    }
</style>

<div class="py-4 my-4">
    <h2 class="card-title">
        <strong>External API</strong>
    </h2>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        @foreach($posts as $post)
        <div class="col">
            <a data-bs-toggle="modal" data-bs-target="#show{{$post['id']}}">
                <div class="card shadow-sm p-2 rounded post-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucwords($post['title']) }}</h5>
                        <p class="card-text pt-2">{{ ucfirst($post['body']) }}</p>
                        <small><i>by User {{ $post['userId'] }}</i></small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal starts here -->
@foreach($posts as $post)
<div class="modal fade" id="show{{$post['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>{{ ucwords($post['title']) }}</h5>
                <p>{{ ucfirst($post['body']) }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>&nbsp; Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal ends here -->
@endsection
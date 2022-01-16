@extends('layout')
@section('content')

<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Event</div>

                <div class="card-body">                    

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Event Name</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?=$event->name?>" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?=$event->slug?>" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Created At</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?=date('d/m/Y h:i:s A', strtotime($event->createdAt))?>" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Updated At</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?=date('d/m/Y h:i:s A', strtotime($event->updatedAt))?>" />
                        </div>
                    </div>
                    <hr>
                    <a href="<?=route('event_list_web')?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
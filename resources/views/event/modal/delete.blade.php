<div class="modal fade" id="eventDelete{{$event['id']}}" tabindex="-1" aria-hidden="true">
    <form id="destroyEvent" name="destroyEvent" action="{{route('destroyEvent',$event['id'])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDeleteLabel">Delete Event</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$event['name']}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{$event['slug']}}" disabled>
                    </div>
                    <input type="text" class="form-control" id="id" name="id" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" value={{ $event['id'] }} name="delete" class="btn btn-md btn-danger btn-round btn-icon">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="eventEdit{{$event['id']}}" tabindex="-1" aria-hidden="true">
    <form id="updateEvent" name="updateEvent"  action="{{route('updateEvent',$event['id'])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventEditLabel">Edit Event</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$event['name']}}">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{$event['slug']}}">
                    </div>
                    <input type="text" class="form-control" id="id" name="id" value="{{$event['id']}}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  value={{ $event['id'] }} class="btn btn-md btn-primary btn-round btn-icon me-">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
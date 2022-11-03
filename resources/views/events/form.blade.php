@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        @if($type != "show")
            <h2>{{ ucfirst($type) }} Event</h2>
        @else
            <h2>Event Details</h2>
        @endif
    </div>

    <div class="card p-3">
        <form id="form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Event Name" value="{{ isset($event) ? $event->name : "" }}" required {{ ($type=="show") ? "readonly" : "" }}>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter Slug" value="{{ isset($event) ? $event->slug : "" }}" required {{ ($type=="show") ? "readonly" : "" }}>
            </div>
            <div class="form-group">
                <label for="start_at">Start Date/Time</label>
                <input type="datetime-local" name="start_at" class="form-control" id="start_at" placeholder="Select Date" value="{{ isset($event) ? date('Y-m-d\TH:i', strtotime($event->start_at)) : "" }}" required {{ ($type=="show") ? "readonly" : "" }}>
            </div>
            <div class="form-group">
                <label for="end_at">End Date/Time</label>
                <input type="datetime-local" name="end_at" class="form-control" id="end_at" placeholder="Select Date" value="{{ isset($event) ? date('Y-m-d\TH:i', strtotime($event->end_at)) : "" }}" required {{ ($type=="show") ? "readonly" : "" }}>
            </div>
            @if($type != "show")
                <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
                <a href="/events" class="btn btn-danger">Cancel</a>
            @else
                <a href="/events" class="btn btn-primary">Go Back</a>
            @endif
        </form>
    </div>

    @if($type != "show")
        <script>
            @if($type == "create")
                var type = 'POST';
                var url = "{{ env('API_URL') . "/events" }}";
                var success_msg = "Event Successfully Created!";
            @else
                var type = 'PUT';
                var url = "{{ env('API_URL') . "/events/" . $event->id }}";
                var success_msg = "Event Successfully Updated!";
            @endif

            $(document).on('click','#btn_submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                $.ajax({
                    type: type,
                    url: url,
                    contentType: "application/json",
                    data: $("#form").serialize(),
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "Authorization": "Bearer {{ $session_id }}"
                    },
                    success: function(data){
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: success_msg,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                @if($type == "create")
                                    window.location.href = "/events";
                                @endif
                            })
                        } else {
                            var message = "";
                            $.each(data.message, function (i, v) {
                                message += v + "<br>";
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: message,
                            })
                        }
                    },
                    error: function (data) {
                        var json = JSON.parse(data.responseText);

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: json.message,
                        }).then((result) => {
                            window.location.href = '/';
                        });
                    }
                });
            });
        </script>
    @endif
@endsection

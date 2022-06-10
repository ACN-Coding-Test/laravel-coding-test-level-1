@extends('master')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    2-ui-create
                </h1>

                @php

                    $forms = [
                  'name'=>'text',
                  'slug'=>'test',
                  'startAt'=> 'datetime-local',
                  'endAt'=> 'datetime-local',


                ];

                @endphp
                <a class="mb-3" href="{{route('events.get')}}">
                    <h3>BACK</h3>
                </a>
                <form method="POST" action="{{env('APP_URL')}}api/v1/events{{($event ?? null) ? "/$event->id" : ""}}">

                    @if($event ?? null)


                        <h1>Editing id {{$event->id}}</h1>
                        <input type="text" hidden id="{{$event->id}}" />
                        @method('patch')
                    @endif
                    @foreach($forms as $form=>$type)
                        <div class="form-group mt-3">

                            <label for="exampleInputEmail1">{{strtoupper($form)}}</label>
                            <input type="{{$type}}" class="form-control" id="#{{$form}}"
                                   aria-describedby="emailHelp"
                                   name="{{$form}}"
                                   @if($event ?? null)
                                     value="{{$event->$form}}"

                                   @endif
                                   placeholder="Enter {{$form}}">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


@endsection


@section('script')


    <script>

        $(document).ready(function () {
            $("form").submit(function(e){
                e.preventDefault(); // avoid to execute the actual submit of the form.

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    method: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        alert(data.message); // show response from the php script.
                        @if(!($event??null))
                        form.find('input').val('');
                        @endif
                    },
                    error: function(data){
                        console.log(data);
                        var message = "";
                        for(var key in data.responseJSON.errors){
                            var value = data.responseJSON.errors[key];
                            console.log(value)
                            value.forEach(function(current){
                                message += current + "\n";
                            })
                        }
                        alert(message);
                    }
                });
            });
        })
    </script>

@append
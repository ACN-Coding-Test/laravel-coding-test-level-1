@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Create Event</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('events.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Event Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">    
              <label for="startAt">Start At:</label>
              <input class="date form-control" type="text" name="startAt" autocomplete="off">
          </div>
          <div class="form-group">    
              <label for="endAt">End At:</label>
              <input class="date form-control" type="text" name="endAt" autocomplete="off">
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Add event</button>
      </form>
  </div>
</div>
</div>
@endsection
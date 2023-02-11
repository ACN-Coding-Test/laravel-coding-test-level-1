<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Event</title>
  <!-- Add any additional CSS or JavaScript files here -->
</head>
<body>
    <h1>Edit Event</h1>
    <form action="{{ route('events.update', $event->id) }}" method="post">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $event->name }}" required>
    </div>
    <div>
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" value="{{ $event->slug }}" required>
    </div>
    <div>
        <label for="created_at">Created At:</label>
        <input type="datetime-local" id="created_at" name="created_at" value="{{ $event->created_at->format('Y-m-d\TH:i') }}" required>
    </div>
    <div>
        <label for="updated_at">Updated At:</label>
        <input type="datetime-local" id="updated_at" name="updated_at" value="{{ $event->updated_at->format('Y-m-d\TH:i') }}" required>
    </div>
    <a href="/events" class="btn btn-primary">Update</a>
    </form>
</body>
</html>
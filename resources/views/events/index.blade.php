<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Events</title>
  <!-- Add any additional CSS or JavaScript files here -->
</head>
<body>
    <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($events as $event)
            <tr>
              <td>{{ $event->id }}</td>
              <td>{{ $event->name }}</td>
              <td>{{ $event->slug }}</td>
              <td>{{ $event->created_at }}</td>
              <td>{{ $event->updated_at }}</td>
              <td>
                <a class="btn btn-primary" href="/events/{{$id}}/edit">>Edit</a>
                <a class="btn btn-danger" href="/events/{{$id}}/delete">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>
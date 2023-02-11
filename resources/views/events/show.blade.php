<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Event</title>
  <!-- Add any additional CSS or JavaScript files here -->
</head>
<body>
  <table>
    <tbody>
      <tr>
        <td>ID</td>
        <td>{{ $event->id }}</td>
      </tr>
      <tr>
        <td>Name</td>
        <td>{{ $event->name }}</td>
      </tr>
      <tr>
        <td>Slug</td>
        <td>{{ $event->slug }}</td>
      </tr>
      <tr>
        <td>Created At</td>
        <td>{{ $event->created_at }}</td>
      </tr>
      <tr>
        <td>Updated At</td>
        <td>{{ $event->updated_at }}</td>
      </tr>
    </tbody>
  </table>
  <a href="/events">Back to events</a>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events List</title>
</head>
<body>
    <table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No events found without reservations.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
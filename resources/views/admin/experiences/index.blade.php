<!DOCTYPE html>
<html>
<head>
    <title>Experiences</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        a.button { padding: 5px 10px; background: #3490dc; color: white; text-decoration: none; border-radius: 4px; margin-right: 5px; }
    </style>
</head>
<body>
<h1>Experiences</h1>
<a href="{{ route('experiences.create') }}" class="button">Add New Experience</a>
<table>
    <thead>
        <tr>
            <th>Profile</th>
            <th>Company</th>
            <th>Role</th>
            <th>Start</th>
            <th>End</th>
            <th>Techstack</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($experiences as $exp)
        <tr>
            <td>{{ $exp->profile->name }}</td>
            <td>{{ $exp->company }}</td>
            <td>{{ $exp->role }}</td>
            <td>{{ $exp->start_date }}</td>
            <td>{{ $exp->end_date ?? '-' }}</td>
            <td>{{ $exp->techstack }}</td>
            <td>
                <a href="{{ route('experiences.edit', $exp) }}" class="button">Edit</a>
                <form action="{{ route('experiences.destroy', $exp) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button" style="background:#e3342f;">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
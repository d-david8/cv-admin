<!DOCTYPE html>
<html>
<head>
    <title>Edit Experience</title>
</head>
<body>
<h1>Edit Experience</h1>
<form action="{{ route('experiences.update', $experience) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Profile:</label>
    <select name="profile_id" required>
        @foreach($profiles as $profile)
            <option value="{{ $profile->id }}" {{ $experience->profile_id == $profile->id ? 'selected' : '' }}>
                {{ $profile->name }}
            </option>
        @endforeach
    </select><br>

    <label>Company:</label>
    <input type="text" name="company" value="{{ $experience->company }}" required><br>

    <label>Role:</label>
    <input type="text" name="role" value="{{ $experience->role }}" required><br>

    <label>Start Date:</label>
    <input type="date" name="start_date" value="{{ $experience->start_date }}" required><br>

    <label>End Date:</label>
    <input type="date" name="end_date" value="{{ $experience->end_date }}"><br>

    <label>Description:</label>
    <textarea name="description">{{ $experience->description }}</textarea><br>

    <label>Techstack:</label>
    <input type="text" name="techstack" value="{{ $experience->techstack }}"><br>

    <button type="submit">Update Experience</button>
</form>
</body>
</html>

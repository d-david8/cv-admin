<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Experience - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="container mx-auto px-4 py-6 max-w-3xl">

    <h1 class="text-3xl font-bold mb-6">Add Experience for {{ $profile->name }}</h1>

    <a href="{{ route('profiles.show', $profile->id) }}" class="text-blue-500 mb-4 inline-block">← Back to Profile</a>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profiles.experiences.store', $profile->id) }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profile->id }}">

        <label>Company:</label>
        <input type="text" name="company" class="w-full border px-3 py-2 rounded" required>

        <label>Role:</label>
        <input type="text" name="role" class="w-full border px-3 py-2 rounded" required>

        <label>Start Date:</label>
        <input type="date" name="start_date" class="w-full border px-3 py-2 rounded" required>

        <label>End Date:</label>
        <input type="date" name="end_date" class="w-full border px-3 py-2 rounded">

        <label>Description:</label>
        <textarea name="description" class="w-full border px-3 py-2 rounded"></textarea>

        <label>Tech Stacks:</label>
        <select name="techstacks[]" id="techstacks" multiple class="border px-3 py-2 rounded w-full">
            @foreach($techstacks as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }} ({{ $tech->level ?? 'N/A' }})</option>
            @endforeach
        </select>


        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Add Experience</button>
    </form>


</div>
</body>
</html>

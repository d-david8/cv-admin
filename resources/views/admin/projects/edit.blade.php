@extends('layouts.admin')

@section('title', 'Edit project')

@section('page-title', 'Edit project')

@section('content')

<a href="{{ route('profiles.show', $project->profile_id) }}"
    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition mb-8">
    ← Back
</a>

<!-- FORM -->
<form action="{{ route('projects.update', $project) }}"
        method="POST"
        class="bg-white shadow rounded-2xl p-6 space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-medium mb-1">Project name *</label>
            <input type="text"
                    name="name"
                    value="{{ old('company', $project->name) }}"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
        </div>

        <div>
            <label class="block font-medium mb-1">Link *</label>
            <input type="text"
                    name="link"
                    value="{{ old('link', $project->link) }}"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div>
        <label class="block font-medium mb-1">Description</label>
        <textarea name="description"
                    rows="4"
                    class="w-full border rounded-lg px-3 py-2">{{ old('description', $project->description) }}</textarea>
    </div>


    <!-- TECH STACK -->
    <div>
        <label class="font-medium block mb-2">Tech Stack</label>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach($techstacks as $tech)
                <label class="flex items-center gap-2 bg-gray-50 border rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-100">
                    <input type="checkbox"
                        name="techstacks[]"
                        value="{{ $tech->id }}"
                        class="rounded text-indigo-600"
                        {{ $project->techstacks->contains($tech->id) ? 'checked' : '' }}>
                    <span>
                        {{ $tech->name }}
                        @if($tech->level)
                        <span class="text-xs text-gray-500">
                            ({{ $tech->level}})
                        </span>
                        @endif
                    </span>
                </label>
            @endforeach
        </div>
    </div>


    <!-- ACTIONS -->
    <div class="flex flex-col sm:flex-row gap-3 pt-4">
        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow transition">
            Update project
        </button>

        <a href="{{ route('profiles.show', $project->profile_id) }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg text-center transition">
            Cancel
        </a>
    </div>

</form>

@endsection

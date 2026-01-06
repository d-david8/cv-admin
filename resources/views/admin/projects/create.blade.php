@extends('layouts.admin')

@section('title', 'Add  ' . $profile->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">
            Add project
            <span class="text-gray-400 text-lg font-normal">
                - {{ $profile->name }}
            </span>
        </h1>

        <a href="{{ route('profiles.show', $profile) }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
            ← Back
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('profiles.projects.store', $profile) }}"
          method="POST"
          class="bg-white shadow rounded-2xl p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="font-medium">Project name</label>
                <input type="text" name="name"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="font-medium">Link</label>
                <input type="link" name="link"
                       placeholder ="https://github/username/project"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>
        </div>

        <div>
            <label class="font-medium">Description</label>
            <textarea name="description"
                      rows="4"
                      class="w-full border rounded-lg px-3 py-2"></textarea>
        </div>

        <!-- TECH STACK SELECT -->
        <div>
            <label class="font-medium block mb-2">Tech Stack</label>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach($techstacks as $tech)
                    <label class="flex items-center gap-2 bg-gray-50 border rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-100">
                        <input type="checkbox"
                               name="techstacks[]"
                               value="{{ $tech->id }}"
                               class="rounded text-indigo-600">
                        <span>
                            {{ $tech->name }}
                            <span class="text-xs text-gray-500">
                                ({{ $tech->level ?? '' }})
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow">
                Save project
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Experience')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold">Edit Experience</h1>

        <a href="{{ route('profiles.show', $experience->profile_id) }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
            ← Back to Profile
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('experiences.update', $experience) }}"
          method="POST"
          class="bg-white shadow rounded-2xl p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- COMPANY + ROLE -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Company *</label>
                <input type="text"
                       name="company"
                       value="{{ old('company', $experience->company) }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="block font-medium mb-1">Role *</label>
                <input type="text"
                       name="role"
                       value="{{ old('role', $experience->role) }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>
        </div>

        <!-- DATES -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Start Date *</label>
                <input type="date"
                       name="start_date"
                       value="{{ old('start_date', $experience->start_date) }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="block font-medium mb-1">End Date</label>
                <input type="date"
                       name="end_date"
                       value="{{ old('end_date', $experience->end_date) }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description"
                      rows="4"
                      class="w-full border rounded-lg px-3 py-2">{{ old('description', $experience->description) }}</textarea>
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
                            {{ $experience->techstacks->contains($tech->id) ? 'checked' : '' }}>
                        <span>
                            {{ $tech->name }}
                            <span class="text-xs text-gray-500">
                                ({{ $tech->level ?? '—' }})
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>
        </div>


        <!-- ACTIONS -->
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow transition">
                Update Experience
            </button>

            <a href="{{ route('profiles.show', $experience->profile_id) }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg text-center transition">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection

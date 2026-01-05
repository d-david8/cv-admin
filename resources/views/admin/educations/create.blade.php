@extends('layouts.admin')

@section('title', 'Add Education – ' . $profile->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">
            Add Education
            <span class="text-gray-400 text-lg font-normal">
                – {{ $profile->name }}
            </span>
        </h1>

        <a href="{{ route('profiles.show', $profile) }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
            ← Back
        </a>
    </div>

    <!-- ERRORS -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('profiles.educations.store', $profile) }}"
          method="POST"
          class="bg-white shadow rounded-2xl p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="font-medium">School</label>
                <input type="text"
                       name="school"
                       value="{{ old('school') }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="font-medium">Degree</label>
                <input type="text"
                       name="degree"
                       value="{{ old('degree') }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="font-medium">Start Date</label>
                <input type="date"
                       name="start_date"
                       value="{{ old('start_date') }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="font-medium">End Date</label>
                <input type="date"
                       name="end_date"
                       value="{{ old('end_date') }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>
        </div>

        <div>
            <label class="font-medium">Description</label>
            <textarea name="description"
                      rows="4"
                      class="w-full border rounded-lg px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow">
                Save Education
            </button>
        </div>
    </form>
</div>
@endsection

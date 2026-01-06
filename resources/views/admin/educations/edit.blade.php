@extends('layouts.admin')

@section('title', 'Edit education - ' . $profile->name)

@section('page-title', 'Edit education - ' . $profile->name)

@section('content')

<div class="flex flex-wrap gap-2 mt-2 md:mt-0 mb-8">
    <a href="{{ route('profiles.show', $profile) }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
        ← Back
    </a>
</div>
    <!-- FORM -->
<form action="{{ route('educations.update', [$profile, $education]) }}"
        method="POST"
        class="bg-white shadow rounded-2xl p-6 space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="font-medium">School <span class="text-red-500">*</span></label>
            <input type="text"
                    name="school"
                    value="{{ old('school', $education->school) }}"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
        </div>

        <div>
            <label class="font-medium">Degree <span class="text-red-500">*</span></label>
            <input type="text"
                    name="degree"
                    value="{{ old('degree', $education->degree) }}"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
        </div>

        <div>
            <label class="font-medium">Start date <span class="text-red-500">*</span></label>
            <input type="date"
                    name="start_date"
                    value="{{ old('start_date', $education->start_date) }}"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
        </div>

        <div>
            <label class="font-medium">End date</label>
            <input type="date"
                    name="end_date"
                    value="{{ old('end_date', $education->end_date) }}"
                    class="w-full border rounded-lg px-3 py-2">
        </div>
    </div>

    <div>
        <label class="font-medium">Description <span class="text-red-500">*</span></label>
        <textarea name="description"
                    required
                    rows="4"
                    class="w-full border rounded-lg px-3 py-2">{{ old('description', $education->description) }}</textarea>
    </div>

    <div class="flex justify-end">
        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
            Update education
        </button>
    </div>
</form>

@endsection

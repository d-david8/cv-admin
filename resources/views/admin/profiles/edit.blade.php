@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Edit Profile</h1>
        <a href="{{ route('profiles.show', $profile) }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
           ← Back
        </a>
    </div>


    <!-- FORM -->
    <form action="{{ route('profiles.update', $profile) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
        @csrf
        @method('PUT')

        <!-- GRID BASIC INFO -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}"
                       class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $profile->title) }}"
                       class="w-full border px-3 py-2 rounded" required>
            </div>
        </div>

        <!-- SUMMARY -->
        <div>
            <label class="block font-medium mb-1">Summary <span class="text-red-500">*</span></label>
            <textarea name="summary" rows="4" class="w-full border px-3 py-2 rounded" required>{{ old('summary', $profile->summary) }}</textarea>
        </div>

        <!-- GRID CONTACT -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                       class="w-full border px-3 py-2 rounded" required
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                       title="Enter a valid email">
            </div>
            <div>
                <label class="block font-medium mb-1">Phone <span class="text-red-500">*</span></label>
                <input type="tel" name="phone" value="{{ old('phone', $profile->phone) }}"
                       class="w-full border px-3 py-2 rounded" required
                       pattern="^\+?\d{7,15}$" 
                       title="Enter a valid phone number (7-15 digits)">
            </div>
        </div>

        <!-- GRID LINKS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">LinkedIn <span class="text-red-500">*</span></label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}"
                       class="w-full border px-3 py-2 rounded" placeholder="https://linkedin.com/in/username" required>
            </div>
            <div>
                <label class="block font-medium mb-1">GitHub <span class="text-red-500">*</span></label>
                <input type="url" name="github" value="{{ old('github', $profile->github) }}"
                       class="w-full border px-3 py-2 rounded" placeholder="https://github.com/username" required>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow transition">
                Save Changes
            </button>
            <a href="{{ url()->previous() }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded text-center transition">
               Cancel
            </a>
        </div>

    </form>

</div>
@endsection

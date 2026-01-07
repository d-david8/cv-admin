@extends('layouts.admin')

@section('title', 'Add new profile')

@section('page-title','Add new profile')

@section('content')

<!-- Header Back -->
<div class="flex flex-wrap gap-2 mt-2 md:mt-0 mb-8">
    <a href="{{ route('profiles.index') }}" 
        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
        ← Back
    </a>
</div>

<!-- Form -->
<form action="{{ route('profiles.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-4">
    @csrf

    <!-- Basic information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-medium mb-1">Full name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    required>
        </div>
        <div>
            <label class="block font-medium mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" 
                    class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    required>
        </div>
    </div>

    <!-- Summary -->
    <div>
        <label class="block font-medium mb-1">Summary <span class="text-red-500">*</span></label>
        <textarea name="summary" rows="4" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    required>{{ old('summary') }}</textarea>
    </div>

    <!-- Contact information-->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-medium mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" 
                    class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    title="Please enter a valid email">
        </div>
        <div>
            <label class="block font-medium mb-1">Phone <span class="text-red-500">*</span></label>
            <input type="tel" name="phone" value="{{ old('phone') }}" 
                    class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    required
                    pattern="^\+?\d{10,15}$"
                    title="Enter a valid phone number (10-15 digits)">
        </div>
    </div>

    <!-- Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-medium mb-1">LinkedIn <span class="text-red-500">*</span></label>
            <input type="url" name="linkedin" value="{{ old('linkedin') }}" 
                    class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    placeholder="https://linkedin.com/in/username"
                    required>
        </div>
        <div>
            <label class="block font-medium mb-1">GitHub <span class="text-red-500">*</span></label>
            <input type="url" name="github" value="{{ old('github') }}" 
                    class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    placeholder="https://github.com/username"
                    required>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row gap-3 pt-4">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow transition">
            Save profile
        </button>
        <a href="{{ route('profiles.index') }}" 
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-6 rounded-lg text-center transition">
            Cancel
        </a>
    </div>

</form>
@endsection
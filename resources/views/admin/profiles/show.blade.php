@extends('layouts.admin')

@section('title', $profile->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <!-- Nume + edit + title -->
        <div class="flex flex-col">
            <div class="flex items-center gap-2">
                <h1 class="text-3xl font-bold">{{ $profile->name }}</h1>

                <!-- Edit icon -->
                <a href="{{ route('profiles.edit', $profile->id) }}" 
                class="text-yellow-500 hover:text-yellow-700" title="Edit Profile">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </a>
            </div>

            <!-- Title -->
            @if($profile->title)
                <p class="text-gray-500 mt-1 text-sm">{{ $profile->title }}</p>
            @endif
        </div>

        <!-- Back button -->
        <div class="flex flex-wrap gap-2 mt-2 md:mt-0">
            <a href="{{ route('profiles.index') }}" 
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
            ← Back
            </a>
        </div>

    </div>

    <!-- Profile Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Contact -->
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Contact</h2>
            <ul class="space-y-3 text-sm">
                <li><span class="font-bold">Email:</span> {{ $profile->email }}</li>
                <li><span class="font-bold">Phone:</span> {{ $profile->phone ?? '-' }}</li>
                <li><span class="font-bold">LinkedIn:</span> {{ $profile->linkedin ?? '-' }}</li>
                <li><span class="font-bold">GitHub:</span> {{ $profile->github ?? '-' }}</li>
            </ul>
        </div>

        <!-- Summary -->
        <div class="bg-white rounded-2xl shadow p-6 lg:col-span-2">
            <h2 class="text-lg font-semibold mb-4">Summary</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $profile->summary ?? 'No summary provided.' }}
            </p>
        </div>

    </div>

    <!-- Tech Stack -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <h2 class="text-xl font-semibold">Tech Stack</h2>

            <a href="{{ route('profiles.techstacks.index', $profile) }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                Manage Tech Stack
            </a>
        </div>

        @if($profile->techStacks->isEmpty())
            <p class="text-gray-500">No technologies added.</p>
        @else
            <div class="flex flex-wrap gap-2">
                @foreach($profile->techStacks as $tech)
                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-bold">
                        {{ $tech->name }}
                        @if($tech->level)
                            <span class="opacity-70">• {{ $tech->level }}</span>
                        @endif
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Experiences -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
        <h2 class="text-2xl font-bold">Experiences</h2>

        <a href="{{ route('profiles.experiences.create', $profile->id) }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow-sm transition">
            + Add Experience
        </a>
    </div>

    <div class="space-y-4">
        @forelse($profile->experiences as $exp)
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">

                    <div>
                        <h3 class="text-lg font-semibold">
                            {{ $exp->role }}
                            <span class="text-indigo-600">@ {{ $exp->company }}</span>
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}
                        </p>

                        @if($exp->description)
                            <p class="mt-3 text-gray-700 leading-relaxed">
                                {{ $exp->description }}
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('experiences.edit', $exp) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded transition">
                            Edit
                        </a>

                        <form action="{{ route('experiences.destroy', $exp) }}" method="POST" class="relative">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded transition">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">
                No experiences added yet.
            </div>
        @endforelse
    </div>

</div>

@endsection

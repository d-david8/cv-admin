@extends('layouts.admin')

@section('title', $profile->name)

@section('page-title','Profile page')

@section('content')

<!-- Header back -->
<div class="flex flex-wrap gap-2 mt-2 md:mt-0 mb-8">
    <a href="{{ route('profiles.index') }}" 
        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
        ← Back
    </a>
</div>

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 mt-8">
    <!-- Nume + edit + title -->
    <div class="flex flex-col">
        <div class="flex items-center gap-2">
            <h1 class="text-3xl font-bold">{{ $profile->name }}</h1>

            <!-- Edit icon -->
            <a href="{{ route('profiles.edit', $profile->id) }}" 
            class="text-yellow-500 hover:text-yellow-700" title="Edit Profile">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
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
            <p class="text-gray-500 mt-1 text-lg">{{ $profile->title }}</p>
        @endif
    </div>
</div>

<!-- Profile information -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <!-- Contact information-->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Contact</h2>
        <ul class="space-y-3 text-s">
            <li class="flex justify-between">
                <span class="font-medium">Email:</span>
                <span class="text-gray-600">{{ $profile->email }}</span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium">Phone:</span>
                <span class="text-gray-600">{{ $profile->phone ?? '-' }}</span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium">LinkedIn:</span>
                <span class="text-gray-600">
                    @if($profile->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $profile->linkedin }}
                        </a>
                    @else
                        -
                    @endif
                </span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium">GitHub:</span>
                <span class="text-gray-600">
                    @if($profile->github)
                        <a href="{{ $profile->github }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $profile->github }}
                        </a>
                    @else
                        -
                    @endif
                </span>
            </li>
        </ul>
    </div>

    <!-- Summary -->
    <div class="bg-white rounded-2xl shadow p-6 lg:col-span-2">
        <h2 class="text-xl font-semibold mb-4">Summary</h2>
        <p class="text-gray-700 leading-relaxed text-s">
            {{ $profile->summary ?? 'No summary provided.' }}
        </p>
    </div>
</div>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
    <h2 class="text-2xl font-bold">Tech stack</h2>
    <a href="{{ route('profiles.techstacks.index', $profile) }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            Manage Tech Stack
    </a>
</div>

<!-- Tech Stack -->
<div class="bg-white rounded-2xl shadow p-6 mb-8">
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
        class="bg-green-600 hover:bg-green-700 text-white text-l px-4 py-2 rounded-lg shadow flex items-center gap-2">
        + Add experience
    </a>
</div>

<!-- List of experiences -->
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
                        {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} - 
                        {{ $exp->end_date
                            ? \Carbon\Carbon::parse($exp->end_date)->format('M Y')
                            : 'Present'
                        }}
                    </p>

                    @if($exp->description)
                        <p class="mt-3 text-gray-700 leading-relaxed">
                            {{ $exp->description }}
                        </p>
                    @endif

                    @if($exp->techstacks->isNotEmpty())
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($exp->techstacks as $tech)
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

                <div class="flex gap-2 shrink-0">
                    <!-- Edit experience -->
                    <a href="{{ route('experiences.edit', $exp) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>
                    
                    <!-- Delete experience-->
                    <form id="delete-exp-{{ $exp->id }}" 
                        action="{{ route('experiences.destroy', $exp) }}" 
                        method="POST" 
                        class="relative">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="delete-btn text-red-500 hover:text-red-700 inline-flex items-center"
                                data-form="delete-exp-{{ $exp->id }}"
                                data-message="Are you sure you want to delete the experience '{{ $exp->role ?? 'Experience' }}'? This action cannot be undone."
                                title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                        a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                            </svg>
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

<!-- Education -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-10 mb-4">
    <h2 class="text-2xl font-bold">Education</h2>

    <a href="{{ route('profiles.educations.create', $profile) }}"
    class="bg-green-600 hover:bg-green-700 text-white text-l px-4 py-2 rounded-lg shadow flex items-center gap-2">
        + Add education
    </a>
</div>

<div class="space-y-4">
    @forelse($profile->educations as $edu)
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">

                <div>
                    <h3 class="text-lg font-semibold">
                        {{ $edu->degree }}
                        <span class="text-indigo-600">@ {{ $edu->school }}</span>
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ \Carbon\Carbon::parse($edu->start_date)->format('M Y') }}
                        -
                        {{ $edu->end_date
                            ? \Carbon\Carbon::parse($edu->end_date)->format('M Y')
                            : 'Present'
                        }}
                    </p>

                    @if($edu->description)
                        <p class="mt-3 text-gray-700 leading-relaxed">
                            {{ $edu->description }}
                        </p>
                    @endif
                </div>
                <div class="flex gap-2 shrink-0 items-center">

                    <!-- Edit button -->
                    <a href="{{ route('educations.edit', $edu) }}"
                    class="text-yellow-500 hover:text-yellow-700"
                    title="Edit Education"
                    aria-label="Edit Education">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>

                    <!-- Delete button -->
                    <form id="delete-edu-{{ $edu->id }}" 
                        action="{{ route('educations.destroy', $edu) }}" 
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="delete-btn text-red-500 hover:text-red-700 inline-flex items-center"
                                data-form="delete-edu-{{ $edu->id }}"
                                data-message="Are you sure you want to delete the education '{{ $edu->school ?? 'Education' }}'? This action cannot be undone."
                                title="Delete Education"
                                aria-label="Delete Education">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                        a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">
            No education added yet.
        </div>
    @endforelse
</div>

<!-- Projects -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 mt-8">
    <h2 class="text-2xl font-bold">Projects</h2>
    <a href="{{ route('profiles.projects.create', $profile->id) }}"
        class="bg-green-600 hover:bg-green-700 text-white text-l px-5 py-3 rounded-lg shadow flex items-center gap-2">
        + Add project
    </a>
</div>

<!-- List of projects -->
<div class="space-y-4">
    @forelse($profile->projects as $project)
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">

                <div>
                   <h3 class="text-lg font-semibold flex items-center gap-2">
                        <span>{{ $project->name }}</span>
                        @if($project->link)
                            <a
                                href="{{ $project->link }}"
                                target="_blank"
                                class="text-blue-600 hover:text-blue-800 text-sm underline flex items-center gap-1"
                            >
                                Link
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 3h7m0 0v7m0-7L10 14"/>
                                </svg>
                            </a>
                        @endif
                    </h3>

                    @if($project->description)
                        <p class="mt-3 text-gray-700 leading-relaxed">
                            {{ $project->description }}
                        </p>
                    @endif

                    @if($project->techstacks->isNotEmpty())
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($project->techstacks as $tech)
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

                <div class="flex gap-2 shrink-0 items-center">

                    <!-- Edit project -->
                    <a href="{{ route('projects.edit', $project) }}"
                    class="text-yellow-500 hover:text-yellow-700"
                    title="Edit Project"
                    aria-label="Edit Project">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>

                    <!-- Delete project -->
                    <form id="delete-project-{{ $project->id }}"
                        action="{{ route('projects.destroy', $project) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="delete-btn text-red-500 hover:text-red-700 inline-flex items-center"
                                data-form="delete-project-{{ $project->id }}"
                                data-message="Are you sure you want to delete the project '{{ $project->name }}'? This action cannot be undone."
                                title="Delete Project"
                                aria-label="Delete Project">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                        a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">
            No projects added yet.
        </div>
    @endforelse
</div>


@endsection

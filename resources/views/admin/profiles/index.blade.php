@extends('layouts.admin')

@section('title', 'Profiles')

@section('page-title','Profiles')

@section('content')

<!-- Add a new profile -->
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
    <a href="{{ route('profiles.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-l px-6 py-2 rounded-lg shadow flex items-center gap-2"> 
        +  Add a new profile
    </a>
</div>


<!-- Tabel Profiles -->
<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-4 py-2 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-2 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-4 py-2 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-4 py-2 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($profiles as $profile)
            <tr class="hover:bg-gray-50 text-lg">
                <td class="px-4 py-2 ">{{ $profile->id }}</td>
                <td class="px-4 py-2">{{ $profile->name }}</td>
                <td class="px-4 py-2">{{ $profile->title }}</td>
                <td class="px-4 py-2">{{ $profile->email }}</td>
                <td class="px-4 py-2 flex justify-center gap-2">
                    <!-- View -->
                    <a href="{{ route('profiles.show', $profile->id) }}" class="text-blue-500 hover:text-blue-700" title="View">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </a>

                    <!-- Edit -->
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>

                    <!-- Delete button -->
                    <button class="delete-btn text-red-500 hover:text-red-700" 
                            data-form="delete-profile-{{ $profile->id }}" title="Delete"
                            data-message="Are you sure you want to delete the profile of {{$profile->name}}? This action cannot be undone."
                            >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                        </svg>
                    </button>

                    <form id="delete-profile{{ $profile->id }}" action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
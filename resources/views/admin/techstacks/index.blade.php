@extends('layouts.admin')

@section('title', $profile->name . ' - Tech Stack')
@section('page-title', $profile->name . ' - Manage Tech Stack')

@section('content')

<!-- Back button -->
<a href="{{ route('profiles.show', $profile) }}"
   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
    ← Back
</a>

<!-- ADD TECH STACK -->
<div class="bg-white shadow rounded-2xl p-6 mb-6 mt-4">
    <form action="{{ route('profiles.techstacks.store', $profile) }}"
          method="POST"
          class="flex flex-col sm:flex-row gap-4">
        @csrf

        <!-- Technology name -->
        <label for="name" class="sr-only">Technology Name</label>
        <input id="name"
               type="text"
               name="name"
               placeholder="Technology name"
               class="border rounded-lg px-3 py-2 w-full sm:flex-1"
               required>

        <!-- Level -->
        <label for="level" class="sr-only">Level</label>
        <select id="level"
                name="level"
                class="border rounded-lg px-3 py-2 w-full sm:w-48">
            <option value="">Level</option>
            <option>Beginner</option>
            <option>Intermediate</option>
            <option>Advanced</option>
            <option>Expert</option>
        </select>

        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
            Add
        </button>
    </form>
</div>

<!-- TECH STACK LIST -->
<div class="bg-white shadow rounded-2xl overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Technology</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Level</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @forelse($techstacks as $tech)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $tech->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $tech->level ?? '—' }}</td>
                    <td class="px-6 py-4 text-right">
                        <!-- Delete button -->
                        <button type="button"
                                class="delete-btn text-red-500 hover:text-red-700 inline-flex items-center"
                                data-form="delete-form-{{ $tech->id }}"
                                data-message="Are you sure you want to delete {{ $tech->name }}?"
                                aria-label="Delete {{ $tech->name }}"
                                title="Delete">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                         a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                            </svg>
                        </button>

                        <!-- Delete form -->
                        <form id="delete-form-{{ $tech->id }}"
                              action="{{ route('techstacks.destroy', $tech) }}"
                              method="POST"
                              class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"
                        class="px-6 py-6 text-center text-gray-400 italic">
                        No tech stack added yet. Start by adding a technology above.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- DELETE CONFIRMATION MODAL -->
<x-delete-modal />

@endsection

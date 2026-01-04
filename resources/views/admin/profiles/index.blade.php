@extends('layouts.admin')

@section('title', 'Profiles')

@section('content')
<h2 class="text-3xl font-bold mb-6">Profiles</h2>

<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-4">
    <a href="{{ route('profiles.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow flex items-center gap-2"> 
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 4v16m8-8H4"/>
        </svg>
        Add Profile
    </a>
</div>

<!-- Tabel Profiles -->
<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($profiles as $profile)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2">{{ $profile->id }}</td>
                <td class="px-4 py-2">{{ $profile->name }}</td>
                <td class="px-4 py-2">{{ $profile->title }}</td>
                <td class="px-4 py-2">{{ $profile->email }}</td>
                <td class="px-4 py-2 flex justify-center gap-2">
                    <!-- View -->
                    <a href="{{ route('profiles.show', $profile->id) }}" class="text-blue-500 hover:text-blue-700" title="View">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </a>

                    <!-- Edit -->
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>

                    <!-- Delete button -->
                    <button class="delete-btn text-red-500 hover:text-red-700" 
                            data-form="delete-form-{{ $profile->id }}" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                        </svg>
                    </button>

                    <form id="delete-form-{{ $profile->id }}" action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal confirm delete -->
<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
        <p class="mb-6">Are you sure you want to delete this profile? This action cannot be undone.</p>
        <div class="flex justify-end space-x-4">
            <button id="cancel-delete" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
            <button id="confirm-delete" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">Delete</button>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
    // toate butoanele delete
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            const formId = this.dataset.form;
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');

            // confirm delete
            document.getElementById('confirm-delete').onclick = () => {
                document.getElementById(formId).submit();
            };

            document.getElementById('cancel-delete').onclick = () => {
                modal.classList.add('hidden');
            };
        });
    });
});
</script>
@endsection



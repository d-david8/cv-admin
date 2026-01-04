@extends('layouts.admin')

@section('title', $profile->name . ' - Tech Stack')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold">
            {{ $profile->name }}
            <span class="text-gray-400 text-lg font-normal">- Tech Stack</span>
        </h1>

        <a href="{{ route('profiles.show', $profile) }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
            ← Back
        </a>
    </div>

    <!-- ADD TECH STACK -->
    <div class="bg-white shadow rounded-2xl p-6 mb-6">
        <form action="{{ route('profiles.techstacks.store', $profile) }}"
              method="POST"
              class="flex flex-col sm:flex-row gap-4">
            @csrf

            <input type="text"
                   name="name"
                   placeholder="Technology name"
                   class="border rounded-lg px-3 py-2 w-full sm:flex-1"
                   required>

            <select name="level"
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Technology
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Level
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($techstacks as $tech)
                    <tr>
                        <td class="px-6 py-4 font-medium">
                            {{ $tech->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $tech->level ?? '—' }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <button
                                type="button"
                                class="delete-btn text-red-500 hover:text-red-700 inline-flex items-center"
                                data-form="delete-form-{{ $tech->id }}"
                                title="Delete">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                            a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                                </svg>
                            </button>

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
                            class="px-6 py-6 text-center text-gray-500">
                            No tech stack added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="delete-modal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Confirm deletion</h2>
        <p class="text-gray-600 mb-6">
            Are you sure you want to delete this technology?
        </p>

        <div class="flex justify-end gap-3">
            <button id="cancel-delete"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">
                Cancel
            </button>

            <button id="confirm-delete"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                Delete
            </button>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', () => {

    // auto hide success
    const alert = document.getElementById('success-alert');
    if (alert) setTimeout(() => alert.remove(), 5000);

    let formToSubmit = null;

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            formToSubmit = document.getElementById(btn.dataset.form);
            document.getElementById('delete-modal').classList.remove('hidden');
        });
    });

    document.getElementById('cancel-delete').onclick = () => {
        document.getElementById('delete-modal').classList.add('hidden');
        formToSubmit = null;
    };

    document.getElementById('confirm-delete').onclick = () => {
        if (formToSubmit) formToSubmit.submit();
    };
});
</script>

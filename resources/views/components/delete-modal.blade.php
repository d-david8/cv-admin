<!-- Delete confirmation modal -->
<div
    id="delete-modal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden p-4 z-50"
>
    <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Confirm deletion</h2>

        <p id="delete-modal-message" class="mb-6">
            Are you sure you want to delete this item? This action cannot be undone.
        </p>

        <div class="flex justify-end space-x-4">
            <button
                id="cancel-delete"
                type="button"
                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
            >
                Cancel
            </button>

            <button
                id="confirm-delete"
                type="button"
                class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600"
            >
                Delete
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('delete-modal');
    const confirmBtn = document.getElementById('confirm-delete');
    const cancelBtn = document.getElementById('cancel-delete');
    const messageEl = document.getElementById('delete-modal-message');

    let currentFormId = null;

    // event delegation (funcționează pentru orice .delete-btn)
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.delete-btn');
        if (!btn) return;

        e.preventDefault();

        currentFormId = btn.dataset.form;
        messageEl.textContent =
            btn.dataset.message ??
            'Are you sure you want to delete this item? This action cannot be undone.';

        modal.classList.remove('hidden');
    });

    confirmBtn.addEventListener('click', () => {
        if (currentFormId) {
            document.getElementById(currentFormId).submit();
        }
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        currentFormId = null;
    });
});
</script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.new-secret-btn').forEach(button => {
        button.addEventListener('click', () => {
            Livewire.dispatch('openAddSecretModal');
        });
    });
});

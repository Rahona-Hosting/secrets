document.querySelectorAll('.input-group input').forEach(input => {
    input.addEventListener('focus', () => {
        const icon = input.parentElement.querySelector('i');
        if (icon) {
            icon.classList.add('text-blue-400');
            icon.classList.remove('text-gray-400');
        }
    });

    input.addEventListener('blur', () => {
        const icon = input.parentElement.querySelector('i');
        if (icon) {
            icon.classList.remove('text-blue-400');
            icon.classList.add('text-gray-400');
        }
    });
});

document.addEventListener('click', (e) => {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (e.target === modal) {
            Livewire.dispatch('closeModal');
        }
    });
});

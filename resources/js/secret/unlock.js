document.addEventListener('livewire:init', () => {
    Livewire.on('secretRevealed', () => {
        const lockIcon = document.querySelector('.fa-lock');
        if (lockIcon) {
            lockIcon.classList.remove('fa-lock', 'float-animation');
            lockIcon.classList.add('fa-lock-open', 'unlock-animation');
        }
    });

    Livewire.on('secretClosed', () => {
        const lockIcon = document.querySelector('.fa-lock-open');
        if (lockIcon) {
            lockIcon.classList.remove('fa-lock-open', 'float-animation');
            lockIcon.classList.add('fa-lock', 'unlock-animation');
        }
    });
});

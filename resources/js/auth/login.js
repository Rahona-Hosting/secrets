document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.querySelector('input[name="remember_me"]');
    const hiddenInput = document.querySelector('input[name="remember"]');

    checkbox?.addEventListener('change', () =>
        hiddenInput.value = checkbox.checked.toString()
    );
});

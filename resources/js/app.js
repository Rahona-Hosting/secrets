import 'flowbite';

import './auth/password-toggle.js'

window.addEventListener('click', function (e) {
    if (!document.querySelector('[wire\\:id]').contains(e.target)) {
        Livewire.dispatch('closeLanguageSelector');
    }
});

const toastConfig = {
    success: {
        icon: 'fa-solid fa-circle-check',
        classes: 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200'
    },
    danger: {
        icon: 'fa-solid fa-circle-xmark',
        classes: 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200'
    },
    warning: {
        icon: 'fa-solid fa-triangle-exclamation',
        classes: 'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200'
    },
    info: {
        icon: 'fa-solid fa-circle-info',
        classes: 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200'
    }
};

const showToast = (message, level = 'info') => {
    const container = document.getElementById('toast-container');
    const template = document.getElementById('toast-template');
    const toast = template.content.firstElementChild.cloneNode(true);

    const config = toastConfig[level];
    const icon = toast.querySelector('.inline-flex i');
    icon.className = `${config.icon} text-xl`;
    toast.classList.add(...config.classes.split(' '));

    toast.querySelector('.ml-3').textContent = message;

    container.appendChild(toast);

    const closeButton = toast.querySelector('button');
    closeButton.addEventListener('click', () => removeToast(toast));

    setTimeout(() => removeToast(toast), 5000);
};

const removeToast = (toast) => {
    toast.classList.add('opacity-0', 'transition-opacity');
    setTimeout(() => toast.remove(), 300);
};

window.addEventListener('toast', event => {
    const {message, level} = event.detail[0];
    showToast(message, level);
});

window.Toast = {
    success: (message) => showToast(message, 'success'),
    danger: (message) => showToast(message, 'danger'),
    warning: (message) => showToast(message, 'warning'),
    info: (message) => showToast(message, 'info')
};

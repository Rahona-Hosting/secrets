import {CryptoUtils} from '../crypto-utils';

document.addEventListener('livewire:init', () => {
    window.togglePasswordVisibility = () => {
        const passwordInput = document.getElementById('e2eePassword');
        const icon = document.getElementById('passwordToggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    };

    Livewire.on('prepare-secret', async (data) => {
        const isE2EE = data[0].isE2EE;
        const tmpSecretTextarea = document.getElementById('tmpSecret');

        if (!tmpSecretTextarea) {
            console.error('Textarea non trouvé');
            return;
        }

        const tmpSecret = tmpSecretTextarea.value;

        if (!tmpSecret) {
            Livewire.dispatch('encryption-failed', {message: window.t.secret.encrypt.can_t_empty});
            return;
        }

        try {
            let finalSecret = tmpSecret;

            if (isE2EE) {
                const passwordInput = document.getElementById('e2eePassword');
                if (!passwordInput) {
                    console.error('Input password non trouvé');
                    return;
                }

                const password = passwordInput.value;

                if (!password || password.length < 6) {
                    Livewire.dispatch('encryption-failed', {message: window.t.secret.encrypt.not_strong});
                    return;
                }

                finalSecret = await CryptoUtils.encrypt(tmpSecret, password);
            }

            Livewire.dispatch('secret-ready', {secret: finalSecret});
        } catch (error) {
            console.error('Erreur:', error);
            Livewire.dispatch('encryption-failed', {message: error.message});
        }
    });

    Livewire.on('secret-modal-closed', () => {
        const tmpSecretTextarea = document.getElementById('tmpSecret');
        const passwordInput = document.getElementById('e2eePassword');
        const icon = document.getElementById('passwordToggleIcon');

        if (tmpSecretTextarea) {
            tmpSecretTextarea.value = '';
        }
        if (passwordInput) {
            passwordInput.value = '';
            passwordInput.type = 'password';
        }
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

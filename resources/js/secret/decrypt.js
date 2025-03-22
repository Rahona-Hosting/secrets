import {CryptoUtils} from '../crypto-utils.js';

const handleDecryption = async (secretContent, decryptPassword, decryptButton) => {
    try {
        const encryptedContent = secretContent.value;
        const password = decryptPassword.value;

        if (!password) {
            window.Toast.danger(window.t.secret.decrypt.no_empty_password);
            return;
        }

        const decryptedContent = await CryptoUtils.decrypt(encryptedContent, password);

        secretContent.type = 'text';
        secretContent.value = decryptedContent;
        secretContent.classList.remove('hidden');

        decryptPassword.classList.add('hidden');
        decryptButton.classList.add('hidden');

        Livewire.dispatch('e2eeCorrectPassword');
    } catch (error) {
        Livewire.dispatch('e2eeWrongPassword');

        alert(error.message);
        decryptPassword.value = '';
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const decryptButton = document.getElementById('decrypt-button');
    if (decryptButton) {
        const secretContent = document.getElementById('secret-content');
        const decryptPassword = document.getElementById('decrypt-password');

        decryptButton.addEventListener('click', () => {
            handleDecryption(secretContent, decryptPassword, decryptButton);
        });
    }
});

if (typeof Livewire !== 'undefined') {
    Livewire.on('secretRevealed', async () => {
        setTimeout(() => {
            const secretContent = document.getElementById('secret-content');
            const decryptPassword = document.getElementById('decrypt-password');
            const decryptButton = document.getElementById('decrypt-button');

            if (secretContent && decryptPassword && decryptButton) {
                decryptButton.addEventListener('click', () => {
                    handleDecryption(secretContent, decryptPassword, decryptButton);
                });
            }
        }, 100);
    });
}

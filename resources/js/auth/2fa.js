document.addEventListener('DOMContentLoaded', function () {
    const recoveryForm = document.getElementById('recoveryForm');
    const otpInputs = document.querySelectorAll('.otp-input');
    const codeInput = document.getElementById('codeInput');
    const verificationForm = document.getElementById('verificationForm');

    window.toggleRecoveryCode = function () {
        if (verificationForm.classList.contains('hidden')) {
            verificationForm.classList.remove('hidden');
            recoveryForm.classList.add('hidden');
        } else {
            verificationForm.classList.add('hidden');
            recoveryForm.classList.remove('hidden');
        }
    };

    otpInputs.forEach((input, index) => {
        input.addEventListener('keyup', function (e) {
            if (e.key === 'Tab' || e.key === 'Shift' || e.key === 'Meta' || e.key === 'Alt' || e.key === 'Control') {
                return;
            }

            if (/^\d$/.test(this.value)) {
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                updateHiddenInput();
            }
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace') {
                if (this.value === '') {
                    if (index > 0) {
                        otpInputs[index - 1].focus();
                    }
                } else {
                    this.value = '';
                }
                updateHiddenInput();
                e.preventDefault();
            }
        });

        input.addEventListener('keypress', function (e) {
            if (!/^\d$/.test(e.key)) {
                e.preventDefault();
            }
        });

        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const pastedData = (e.clipboardData || window.clipboardData)
                .getData('text')
                .trim()
                .slice(0, 6);

            if (/^\d{6}$/.test(pastedData)) {
                pastedData.split('').forEach((char, i) => {
                    otpInputs[i].value = char;
                });
                updateHiddenInput();
            }
        });
    });

    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                const value = mutation.target.value;
                if (value.length === 6) {
                    value.split('').forEach((char, i) => {
                        otpInputs[i].value = char;
                    });
                    updateHiddenInput();
                }
            }
        });
    });

    otpInputs.forEach(input => {
        observer.observe(input, {
            attributes: true,
            attributeFilter: ['value']
        });
    });

    function updateHiddenInput() {
        codeInput.value = Array.from(otpInputs)
            .map(input => input.value)
            .join('');
    }
});

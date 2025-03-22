class PasswordValidator {
    constructor() {
        this.initializeElements();
        this.initializeEventListeners();

        if (this.submitButton) {
            this.submitButton.disabled = true;
        }
    }

    initializeElements() {
        this.usernameInput = document.getElementById('username');
        this.emailInput = document.getElementById('email');
        this.tosCheckbox = document.getElementById('terms');
        this.passwordInput = document.getElementById('password');
        this.confirmInput = document.getElementById('password_confirmation');
        this.strengthMeter = document.getElementById('strengthMeter');
        this.strengthText = document.getElementById('strengthText');
        this.matchMessage = document.getElementById('matchMessage');
        this.submitButton = document.getElementById('submitButton');
    }

    isFormValid() {
        const password = this.passwordInput.value;
        const confirmation = this.confirmInput.value;
        const evaluation = this.evaluatePassword(password);

        return evaluation.score >= 80 &&
            password === confirmation &&
            password.length > 0 &&
            confirmation.length > 0;
    }

    initializeEventListeners() {
        if (this.passwordInput) {
            this.passwordInput.addEventListener('input', () => {
                const score = this.evaluatePassword(this.passwordInput.value);
                this.updateUI(score);
                this.checkPasswordMatch();
            });
        }

        if (this.confirmInput) {
            this.confirmInput.addEventListener('input', () => this.checkPasswordMatch());
        }

        if (this.usernameInput) {
            this.usernameInput.addEventListener('input', () => this.updateSubmitButton());
        }

        if (this.emailInput) {
            this.emailInput.addEventListener('input', () => this.updateSubmitButton());
        }

        if (this.tosCheckbox) {
            this.tosCheckbox.addEventListener('change', () => this.updateSubmitButton());
        }
    }

    evaluatePassword(password) {
        const criteria = {
            hasLength: password.length >= 8,
            hasUpper: /[A-Z]/.test(password),
            hasLower: /[a-z]/.test(password),
            hasNumber: /[0-9]/.test(password),
            hasSpecial: /[^A-Za-z0-9]/.test(password)
        };

        const completedCriteria = Object.values(criteria).filter(Boolean).length;
        const score = (completedCriteria / 5) * 100;

        return {
            score,
            criteria,
            strengthLevel: this.getStrengthLevel(score)
        };
    }

    getStrengthLevel(score) {
        if (score < 40) {
            return {text: window.t.register.password_weak, colorClass: 'red'};
        } else if (score < 80) {
            return {text: window.t.register.password_medium, colorClass: 'yellow'};
        } else {
            return {text: window.t.register.password_strong, colorClass: 'green'};
        }
    }

    updateUI(result) {
        this.strengthMeter.style.width = `${result.score}%`;
        this.strengthMeter.className = `bg-${result.strengthLevel.colorClass}-500`;

        this.strengthText.className = `text-${result.strengthLevel.colorClass}-400 text-sm`;
        this.strengthText.textContent = result.strengthLevel.text;

        this.updateCriteriaIndicators(result.criteria);

        this.updateSubmitButton();
    }

    updateCriteriaIndicators(criteria) {
        const criteriaIds = {
            hasLength: 'lengthCheck',
            hasUpper: 'upperCheck',
            hasLower: 'lowerCheck',
            hasNumber: 'numberCheck',
            hasSpecial: 'specialCheck'
        };

        Object.entries(criteria).forEach(([criterion, isValid]) => {
            const element = document.getElementById(criteriaIds[criterion]);
            if (element) {
                const icon = element.querySelector('i');

                if (isValid) {
                    element.classList.remove('text-gray-400');
                    element.classList.add('text-green-400');
                    icon.classList.remove('fa-times-circle');
                    icon.classList.add('fa-check-circle');
                } else {
                    element.classList.remove('text-green-400');
                    element.classList.add('text-gray-400');
                    icon.classList.remove('fa-check-circle');
                    icon.classList.add('fa-times-circle');
                }
            }
        });
    }

    checkPasswordMatch() {
        if (!this.confirmInput || !this.matchMessage) return;

        const password = this.passwordInput.value;
        const confirm = this.confirmInput.value;

        if (confirm) {
            this.matchMessage.classList.remove('hidden');
            if (password === confirm) {
                this.matchMessage.classList.remove('text-red-400');
                this.matchMessage.classList.add('text-green-400');
                this.matchMessage.innerHTML = `<i class="fas fa-check-circle mr-1"></i> ${window.t.register.password_not_match}`;
            } else {
                this.matchMessage.classList.remove('text-green-400');
                this.matchMessage.classList.add('text-red-400');
                this.matchMessage.innerHTML = `<i class="fas fa-exclamation-circle mr-1"></i> ${window.t.register.password_not_match}`;
            }
        } else {
            this.matchMessage.classList.add('hidden');
        }

        this.updateSubmitButton();
    }

    updateSubmitButton() {
        if (this.submitButton) {
            const password = this.passwordInput.value;
            const confirm = this.confirmInput.value;
            const evaluation = this.evaluatePassword(password);
            const username = this.usernameInput.value;
            const email = this.emailInput.value;
            const tosAccepted = this.tosCheckbox.checked;

            const isValid =
                evaluation.score >= 80 &&
                password === confirm &&
                password.length > 0 &&
                confirm.length > 0 &&
                username.length > 0 &&
                email.length > 0 &&
                tosAccepted;

            this.submitButton.disabled = !isValid;
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new PasswordValidator();
});

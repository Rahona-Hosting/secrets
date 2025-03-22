function copyToClipboard(elementId, buttonId) {
    const urlElement = document.getElementById(elementId);
    const copyButton = document.getElementById(buttonId);

    if (urlElement && copyButton) {
        copyButton.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(urlElement.value);

                // Feedback visuel
                const originalText = copyButton.innerHTML;
                copyButton.innerHTML = `<i class="fas fa-check mr-2"></i>${window.t.secret.copied}`;
                copyButton.classList.add('bg-green-500', 'bg-opacity-20', 'border-green-400', 'text-green-300');
                copyButton.classList.remove('bg-blue-500', 'bg-opacity-20', 'border-blue-400', 'text-blue-300');

                setTimeout(() => {
                    copyButton.innerHTML = originalText;
                    copyButton.classList.remove('bg-green-500', 'bg-opacity-20', 'border-green-400', 'text-green-300');
                    copyButton.classList.add('bg-blue-500', 'bg-opacity-20', 'border-blue-400', 'text-blue-300');
                }, 2000);
            } catch (err) {
                console.error('Erreur lors de la copie :', err);
            }
        });
    }
}

function updateCountdowns() {
    const countdownElements = document.querySelectorAll('[data-countdown]');

    countdownElements.forEach(element => {
        const targetDate = new Date(element.dataset.countdown).getTime();

        const updateTimer = () => {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                element.innerHTML = window.t.secret.expired;
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            let timeString = '';
            if (days > 0) timeString += `${days}j `;
            if (hours > 0) timeString += `${hours}h `;
            if (minutes > 0) timeString += `${minutes}m `;
            timeString += `${seconds}s`;

            element.innerHTML = timeString;
        };

        updateTimer();

        setInterval(updateTimer, 1000);
    });
}

function initSecret() {
    copyToClipboard('share-url', 'copy-button');

    updateCountdowns();
}

document.addEventListener('DOMContentLoaded', initSecret);

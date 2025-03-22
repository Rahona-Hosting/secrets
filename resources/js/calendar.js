import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

document.addEventListener('livewire:initialized', () => {
    const initDatepickers = () => {
        document.querySelectorAll('.datepicker').forEach(element => {
            flatpickr(element, {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
            });
        });
    };

    Livewire.on('requestDatepicker', () => {
        setTimeout(initDatepickers, 100);
    });
});

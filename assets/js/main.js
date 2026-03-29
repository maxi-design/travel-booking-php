document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.getElementById('mainNav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', () => {
            mainNav.classList.toggle('show');
        });
    }

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const target = button.dataset.tab;

            tabButtons.forEach((btn) => btn.classList.remove('active'));
            tabContents.forEach((content) => content.classList.remove('active'));

            button.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });

    const today = new Date().toISOString().split('T')[0];
    const fechaSalida = document.getElementById('fecha_salida');
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');

    if (fechaSalida) {
        fechaSalida.setAttribute('min', today);
    }

    if (checkin) {
        checkin.setAttribute('min', today);

        checkin.addEventListener('change', () => {
            if (checkout) {
                checkout.setAttribute('min', checkin.value);
                if (checkout.value && checkout.value < checkin.value) {
                    checkout.value = '';
                }
            }
        });
    }

    if (checkout && checkin && checkin.value) {
        checkout.setAttribute('min', checkin.value);
    }
});
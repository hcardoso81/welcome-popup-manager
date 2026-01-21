document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('wpm-overlay');
    const modal = overlay?.querySelector('.wpm-modal');
    const closeBtn = modal?.querySelector('.wpm-close');

    if (!overlay || !modal) return;

    const delay = parseInt(modal.dataset.delay, 10) || 0;

    const openModal = () => {
        overlay.style.display = 'flex';
        modal.classList.add('is-visible');
        document.body.classList.add('wpm-modal-open');

        document.cookie = 'wpm_popup_shown=1; path=/';
    };

    const closeModal = () => {
        modal.classList.remove('is-visible');
        document.body.classList.remove('wpm-modal-open');
        overlay.style.display = 'none';
    };

    // Abrir modal con delay
    setTimeout(openModal, delay);

    // Botón cerrar
    closeBtn?.addEventListener('click', closeModal);

    // Click dentro del modal → no cerrar
    modal.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // (opcional) Click en overlay → cerrar
    overlay.addEventListener('click', closeModal);
});

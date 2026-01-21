document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('wpm-overlay');
    const modal = overlay?.querySelector('.wpm-modal');
    const closeBtn = modal?.querySelector('.wpm-close');

    if (!overlay || !modal) return;

    const delay = parseInt(modal.dataset.delay, 10) || 0;

    setTimeout(() => {
        overlay.style.display = 'flex';
        modal.classList.add('is-visible');
        document.cookie = 'wpm_popup_shown=1; path=/';
    }, delay);

    closeBtn?.addEventListener('click', () => {
        overlay.remove();
    });

    // Click dentro del popup → no cerrar
    popup.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Botón cerrar
    closeBtn?.addEventListener('click', () => {
        overlay.remove();
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('wpm-overlay');
    const popup = overlay?.querySelector('.wpm-popup');
    const closeBtn = popup?.querySelector('.wpm-close');

    if (!overlay || !popup) return;

    const delay = parseInt(popup.dataset.delay, 10) || 0;

    setTimeout(() => {
        overlay.style.display = 'flex';
        popup.classList.add('is-visible');
        document.cookie = 'wpm_popup_shown=1; path=/';
    }, delay);

    // Click en overlay → cerrar
    overlay.addEventListener('click', () => {
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

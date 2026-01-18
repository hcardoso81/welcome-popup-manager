(function () {
    const popup = document.getElementById('wpm-popup');
    const overlay = document.getElementById('wpm-overlay');
    const closeBtn = document.getElementById('wpm-close');

    if (!popup || !overlay) return;

    const STORAGE_KEY = 'wpm_popup_seen';

    if (WPM_POPUP.displayMode === 'manual') {
        if (localStorage.getItem(STORAGE_KEY)) {
            return;
        }
    }

    const showPopup = () => {
        popup.classList.remove('wpm-hidden');
        overlay.classList.remove('wpm-hidden');
        localStorage.setItem(STORAGE_KEY, '1');
    };

    const delay = WPM_POPUP.delayEnabled
        ? WPM_POPUP.delaySeconds * 1000
        : 0;

    setTimeout(showPopup, delay);

    closeBtn?.addEventListener('click', closePopup);
    overlay.addEventListener('click', closePopup);

    function closePopup() {
        popup.classList.add('wpm-hidden');
        overlay.classList.add('wpm-hidden');
    }
})();

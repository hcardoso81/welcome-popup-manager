jQuery(document).ready(function ($) {

    /* =====================================================
       IMAGE UPLOADER
    ===================================================== */
    let frame;

    $('#wpm_image_upload').on('click', function (e) {
        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Seleccionar imagen',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false
        });

        frame.on('select', function () {
            const attachment = frame.state().get('selection').first().toJSON();

            $('#wpm_image').val(attachment.url);
            $('#wpm_image_preview')
                .attr('src', attachment.url)
                .show();

        });

        frame.open();
    });

    /* =====================================================
       ENABLED → SHOW / HIDE ALL SETTINGS (DEBUG)
    ===================================================== */

    const enabledCheckbox = $('input[name="wpm_settings[enabled]"]');

    const table = enabledCheckbox.closest('table');

    const rowsToToggle = table.find('tr').not(':first');

    function toggleSettingsPanel() {
        const checked = enabledCheckbox.is(':checked');

        if (checked) {
            rowsToToggle.show();
        } else {
            rowsToToggle.hide();
        }
    }

    toggleSettingsPanel();

    enabledCheckbox.on('change', function () {
        toggleSettingsPanel();
    });

/* =====================================================
   DELAY ENABLED → SHOW / HIDE DELAY SECONDS FIELD
===================================================== */

const delayEnabledCheckbox = $('input[name="wpm_settings[delay_enabled]"]');

// TR del checkbox delay (por claridad)
const delayEnabledRow = delayEnabledCheckbox.closest('tr');

// TR del input seconds
const delaySecondsRow = $('input[name="wpm_settings[delay_seconds]"]').closest('tr');

function toggleDelaySeconds() {
    const checked = delayEnabledCheckbox.is(':checked');

    if (checked) {
        delaySecondsRow.show();
    } else {
        delaySecondsRow.hide();
    }
}

// Estado inicial al cargar la página
toggleDelaySeconds();

// Cambio en vivo
delayEnabledCheckbox.on('change', function () {
    toggleDelaySeconds();
});

});

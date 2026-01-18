jQuery(document).ready(function ($) {
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

    const delayCheckbox = $('input[name="wpm_settings[delay_enabled]"]');
    const delayWrapper = $('#wpm-delay-seconds-wrapper');
    const delayInput = delayWrapper.find('input');

    function toggleDelayField() {
        if (delayCheckbox.is(':checked')) {
            delayWrapper.show();
        } else {
            delayInput.val(0);
            delayWrapper.hide();
        }
    }

    toggleDelayField();

    delayCheckbox.on('change', toggleDelayField);
});

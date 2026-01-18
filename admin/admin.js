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
});

<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_ImageField {

    public static function render(): void {
        $settings = WPM_Settings::fromWp();
        $image = $settings->image();
        ?>
        <input
            type="hidden"
            id="wpm_image"
            name="wpm_settings[image]"
            value="<?php echo esc_url($image); ?>"
        />

        <button type="button" class="button" id="wpm_image_upload">
            Seleccionar imagen
        </button>

        <div style="margin-top:10px;">
            <img
                id="wpm_image_preview"
                src="<?php echo esc_url($image); ?>"
                style="max-width:200px;<?php echo empty($image) ? 'display:none;' : ''; ?>"
            />
        </div>
        <?php
    }
}

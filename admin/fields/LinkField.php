<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_LinkField {

    public static function render(): void {
        $settings = WPM_Settings::fromWp();
        $value = $settings->link();
        ?>
        <input
            type="url"
            name="wpm_settings[link]"
            value="<?php echo esc_url($value); ?>"
            class="regular-text"
            placeholder="https://ejemplo.com"
        />
        <?php
    }
}

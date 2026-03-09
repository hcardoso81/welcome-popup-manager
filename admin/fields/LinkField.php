<?php

namespace WPM1\Admin\Fields;

use WPM1\Domain\Settings;

if (!defined('ABSPATH')) {
    exit;
}

class LinkField {

    public static function render(): void {
        $settings = Settings::fromWp();
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

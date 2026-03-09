<?php

namespace WPM1\Admin\Fields;

use WPM1\Domain\Settings;

if (!defined('ABSPATH')) {
    exit;
}

class DelaySecondsField {

    public static function render(): void {
        $settings = Settings::fromWp();
        $value = $settings->delaySeconds();
        ?>
        <input
            type="number"
            name="wpm_settings[delay_seconds]"
            value="<?php echo esc_attr($value); ?>"
            min="0"
            step="1"
            class="small-text"
        />
        <span>segundos</span>
        <?php
    }
}

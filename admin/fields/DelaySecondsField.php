<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_DelaySecondsField {

    public static function render(): void {
        $settings = WPM_Settings::fromWp();
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

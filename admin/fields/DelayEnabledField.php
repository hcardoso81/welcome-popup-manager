<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_DelayEnabledField {

    public static function render(): void {
        $settings = WPM_Settings::fromWp();
        $checked = $settings->delayEnabled();

        ?>
        <label>
            <input
                type="checkbox"
                name="wpm_settings[delay_enabled]"
                value="1"
                <?php checked($checked); ?>
            />
            Mostrar el popup después de un tiempo
        </label>
        <?php
    }
}

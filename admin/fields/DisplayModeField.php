<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_DisplayModeField {

    public static function render(): void {
        $settings = WPM_Settings::fromWp();
        $value = $settings->displayMode();
        ?>
        <select name="wpm_settings[display_mode]">
            <option value="auto" <?php selected($value, 'auto'); ?>>
                Mostrar siempre que inicie la home
            </option>
            <option value="manual" <?php selected($value, 'manual'); ?>>
                Mostrar solo una vez
            </option>
        </select>
        <?php
    }
}

<?php

namespace WPM\Admin\Fields;

use WPM\Domain\Settings;

if (!defined('ABSPATH')) {
    exit;
}

class DelayEnabledField {

    public static function render(): void {
        $settings = Settings::fromWp();
        $checked = $settings->delayEnabled();

        ?>
        <label>
            <input
                type="checkbox"
                name="wpm_settings[delay_enabled]"
                value="1"
                <?php checked($checked); ?>
            />
            Mostrar el popup después de un tiempo (Opcion destildada: aparece inmediatamente)
        </label>
        <?php
    }
}

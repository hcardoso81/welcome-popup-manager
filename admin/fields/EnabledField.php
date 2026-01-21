<?php

namespace WPM\Admin\Fields;

use WPM\Domain\Settings;

if (!defined('ABSPATH')) {
    exit;
}

class EnabledField
{
    public static function render(): void
    {
        $settings = Settings::fromWp();
?>
        <label>
            <input type="checkbox"
                name="wpm_settings[enabled]"
                value="1"
                <?php checked($settings->isEnabled()); ?> />
            Habilitar popup de bienvenida
        </label>
<?php
    }
}

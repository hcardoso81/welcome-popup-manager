<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_EnabledField
{
    public static function render(): void
    {
        $settings = WPM_Settings::fromWp();
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

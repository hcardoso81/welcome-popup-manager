<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_DescriptionField {

    public static function render(): void {
        $settings = WPM_Settings::fromWp();
        $value = $settings->description();
        
        ?>
        <textarea
            name="wpm_settings[description]"
            rows="5"
            class="large-text"><?php echo esc_textarea($value); ?></textarea>
        <?php
    }
}

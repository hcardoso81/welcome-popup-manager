<?php
// admin/fields/DescriptionField.php

namespace WPM\Admin\Fields;

use WPM\Domain\Settings;

if (!defined('ABSPATH')) {
    exit;
}

class DescriptionField {

    public static function render(): void {
        $settings = Settings::fromWp();
        $value = $settings->description();
        
        ?>
        <textarea
            name="wpm_settings[description]"
            rows="5"
            class="large-text"><?php echo esc_textarea($value); ?></textarea>
        <?php
    }
}

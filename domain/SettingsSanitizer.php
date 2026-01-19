<?php
// domain/SettingsSanitizer.php

if (!defined('ABSPATH')) {
    exit;
}

final class WPM_SettingsSanitizer
{
    public static function sanitize(array $input): array
    {
        $output = [];

        $output['enabled'] = !empty($input['enabled']);

        // Siempre sanitizo todo, pero las reglas deciden si se usan
        $output['description']   = sanitize_textarea_field($input['description'] ?? '');
        $output['link']          = esc_url_raw($input['link'] ?? '');
        $output['image']         = esc_url_raw($input['image'] ?? '');
        $output['delay_enabled'] = !empty($input['delay_enabled']);
        $output['delay_seconds'] = absint($input['delay_seconds'] ?? 0);
        $output['display_mode']  = self::sanitizeDisplayMode($input['display_mode'] ?? '');

        return $output;
    }

    private static function sanitizeDisplayMode(string $value): string
    {
        return in_array($value, ['auto', 'manual'], true)
            ? $value
            : 'auto';
    }
}


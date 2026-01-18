<?php

if (!defined('ABSPATH')) {
    exit;
}

final class WPM_SettingsSanitizer
{
    public static function sanitize(array $input): array
    {
        return [
            'description'   => sanitize_textarea_field($input['description'] ?? ''),
            'link'          => esc_url_raw($input['link'] ?? ''),
            'image'         => esc_url_raw($input['image'] ?? ''),
            'delay_enabled' => isset($input['delay_enabled']),
            'delay_seconds' => absint($input['delay_seconds'] ?? 0),
            'display_mode'  => self::sanitizeDisplayMode($input['display_mode'] ?? ''),
        ];
    }

    private static function sanitizeDisplayMode(string $value): string
    {
        return in_array($value, ['auto', 'manual'], true)
            ? $value
            : 'auto';
    }
}

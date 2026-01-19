<?php
// admin/AdminAssets.php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_AdminAssets
{
    public static function init(): void
    {
        add_action('admin_enqueue_scripts', [self::class, 'enqueue']);
    }

    public static function enqueue(string $hook): void
    {
        /**
         * OPCIONAL pero recomendado:
         * Cargar solo en tu página de settings
         */
        if ($hook !== 'settings_page_wpm-settings') {
            return;
        }

        // Media uploader (OBLIGATORIO para wp.media)
        wp_enqueue_media();

        wp_enqueue_script(
            'wpm-admin-js',
            WPM_PLUGIN_URL . 'admin/assets/admin.js',
            ['jquery'],
            WPM_PLUGIN_VERSION,
            true
        );
    }
}

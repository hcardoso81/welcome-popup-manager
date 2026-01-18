<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_AdminAssets {

    public static function enqueue(string $hook): void {

        if ($hook !== 'toplevel_page_welcome-popup-manager') {
            return;
        }

        wp_enqueue_media();

        wp_enqueue_script(
            'wpm-admin-js',
            WPM_PLUGIN_URL . 'admin/admin.js',
            ['jquery'],
            '1.0',
            true
        );
    }
}

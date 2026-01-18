<?php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_AdminMenu {

    public static function register(): void {
        add_menu_page(
            'Welcome Popup Manager',
            'Welcome Popup',
            'manage_options',
            'welcome-popup-manager',
            [self::class, 'render'],
            'dashicons-format-image'
        );
    }

    public static function render(): void {
        require WPM_PLUGIN_PATH . 'views/admin-settings-page.php';
    }
}

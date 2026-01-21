<?php

namespace WPM\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class AdminMenu {

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

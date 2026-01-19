<?php
// admin/SettingsPageController.php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_SettingsPageController {

    public static function init(): void {
        add_action('admin_menu', [WPM_AdminMenu::class, 'register']);
        add_action('admin_init', [WPM_SettingsRegistry::class, 'register']);
        add_action('admin_enqueue_scripts', [WPM_AdminAssets::class, 'enqueue']);
    }
}

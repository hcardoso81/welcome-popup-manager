<?php
// admin/SettingsPageController.php

namespace WPM1\Admin;

use WPM1\Admin\AdminMenu;
use WPM1\Admin\AdminAssets;
use WPM1\Admin\SettingsRegistry;

if (!defined('ABSPATH')) {
    exit;
}

class SettingsPageController {

    public static function init(): void {
        add_action('admin_menu', [AdminMenu::class, 'register']);
        add_action('admin_init', [SettingsRegistry::class, 'register']);
    }
}

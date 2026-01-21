<?php
// admin/SettingsPageController.php

namespace WPM\Admin;

use WPM\Admin\AdminMenu;
use WPM\Admin\AdminAssets;
use WPM\Admin\SettingsRegistry;

if (!defined('ABSPATH')) {
    exit;
}

class SettingsPageController {

    public static function init(): void {
        add_action('admin_menu', [AdminMenu::class, 'register']);
        add_action('admin_init', [SettingsRegistry::class, 'register']);
    }
}

<?php
// bootstrap/admin.php

namespace WPM1\Bootstrap;

use WPM1\Admin\AdminAssets;
use WPM1\Admin\SettingsPageController;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Bootstrap del Admin
 * Se ejecuta SOLO en el contexto wp-admin
 */

if (!is_admin()) {
    return;
}

/**
 * Includes (si no usás autoload)
 */
require_once WPM1_PLUGIN_PATH . 'admin/AdminMenu.php';
require_once WPM1_PLUGIN_PATH . 'admin/AdminAssets.php';
require_once WPM1_PLUGIN_PATH . 'admin/SettingsRegistry.php';
require_once WPM1_PLUGIN_PATH . 'admin/SettingsPageController.php';

require_once WPM1_PLUGIN_PATH . 'domain/Settings.php';
require_once WPM1_PLUGIN_PATH . 'domain/SettingsSanitizer.php';

require_once WPM1_PLUGIN_PATH . 'admin/fields/SettingsStartField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/SettingsEndField.php';

require_once WPM1_PLUGIN_PATH . 'admin/fields/EnabledField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/DescriptionField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/LinkField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/ImageField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/DelayEnabledField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/DelaySecondsField.php';
require_once WPM1_PLUGIN_PATH . 'admin/fields/DisplayModeField.php';

/**
 * Inicialización
 */
AdminAssets::init(); 
SettingsPageController::init();


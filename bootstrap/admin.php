<?php
// bootstrap/admin.php

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
require_once WPM_PLUGIN_PATH . 'admin/AdminMenu.php';
require_once WPM_PLUGIN_PATH . 'admin/AdminAssets.php';
require_once WPM_PLUGIN_PATH . 'admin/SettingsRegistry.php';
require_once WPM_PLUGIN_PATH . 'admin/SettingsPageController.php';

require_once WPM_PLUGIN_PATH . 'domain/Settings.php';
require_once WPM_PLUGIN_PATH . 'domain/SettingsSanitizer.php';

require_once WPM_PLUGIN_PATH . 'admin/fields/SettingsStartField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/SettingsEndField.php';

require_once WPM_PLUGIN_PATH . 'admin/fields/EnabledField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/DescriptionField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/LinkField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/ImageField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/DelayEnabledField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/DelaySecondsField.php';
require_once WPM_PLUGIN_PATH . 'admin/fields/DisplayModeField.php';

/**
 * Inicialización
 */
WPM_AdminAssets::init(); 
WPM_SettingsPageController::init();


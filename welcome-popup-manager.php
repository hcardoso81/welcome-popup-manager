<?php
// welcome-popup-manager.php
/**
 * Plugin Name: Welcome Popup Manager
 * Plugin URI:  https://github.com/hcardoso81/welcome-popup-manager
 * Description: Displays a configurable welcome popup with image, description and link.
 * Version:     1.0.0
 * Author:      Cardoso Hernan
 * Author URI:  https://www.linkedin.com/in/cardosohernan/
 * Text Domain: welcome-popup-manager
 */

namespace WPM1;

if (!defined('ABSPATH')) {
    exit;
}


if (!defined('WPM1_PLUGIN_PATH')) {
    define('WPM1_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (!defined('WPM1_PLUGIN_URL')) {
    define('WPM1_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('WPM1_PLUGIN_VERSION')) {
    define('WPM1_PLUGIN_VERSION', '1.0.1');
}

require_once WPM1_PLUGIN_PATH . 'bootstrap/admin.php';
require_once WPM1_PLUGIN_PATH . 'bootstrap/public.php';

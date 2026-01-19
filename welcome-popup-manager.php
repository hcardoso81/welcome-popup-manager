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

if (!defined('ABSPATH')) {
    exit;
}

define('WPM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WPM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WPM_PLUGIN_VERSION', '1.0.0');

require_once WPM_PLUGIN_PATH . 'bootstrap/admin.php';
require_once WPM_PLUGIN_PATH . 'bootstrap/public.php';

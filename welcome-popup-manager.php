<?php
/**
 * Plugin Name: Welcome Popup Manager
 * Plugin URI:  https://github.com/hcardoso81/welcome-popup-manager
 * Description: Displays a configurable welcome popup with image, description and link.
 * Version:     1.0.0
 * Author:      Tu Nombre
 * Author URI:  https://www.linkedin.com/in/cardosohernan/
 * Text Domain: welcome-popup-manager
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';

add_action('wp_enqueue_scripts', 'wpm_enqueue_public_assets');

function wpm_enqueue_public_assets() {
    wp_enqueue_style(
        'wpm-popup',
        plugin_dir_url(__FILE__) . 'public/popup.css',
        [],
        '1.0.0'
    );

    wp_enqueue_script(
        'wpm-popup',
        plugin_dir_url(__FILE__) . 'public/popup.js',
        [],
        '1.0.0',
        true
    );

    wp_localize_script('wpm-popup', 'wpmSettings', wpm_get_settings());
}

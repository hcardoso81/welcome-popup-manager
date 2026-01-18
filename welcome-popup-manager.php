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

add_action('wp_enqueue_scripts', 'wpm_enqueue_frontend_assets');

function wpm_enqueue_frontend_assets() {
    $settings = wpm_get_settings();

    wp_enqueue_style(
        'wpm-popup-css',
        plugin_dir_url(__FILE__) . 'public/popup.css',
        [],
        '1.0'
    );

    wp_enqueue_script(
        'wpm-popup-js',
        plugin_dir_url(__FILE__) . 'public/popup.js',
        [],
        '1.0',
        true
    );

    wp_localize_script('wpm-popup-js', 'WPM_POPUP', [
        'delayEnabled' => $settings['delay_enabled'] === '1',
        'delaySeconds' => (int) $settings['delay_seconds'],
        'displayMode'  => $settings['display_mode'],
    ]);
}

add_action('wp_footer', 'wpm_render_popup');

function wpm_render_popup() {
    $settings = wpm_get_settings();

    if (empty($settings['image']) && empty($settings['description'])) {
        return;
    }

    include plugin_dir_path(__FILE__) . 'templates/popup.php';
}


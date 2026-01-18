<?php

if (!defined('ABSPATH')) {
    exit;
}

final class WPM_PopupRenderer
{
    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueueAssets']);
        add_action('wp_footer', [self::class, 'render']);
    }

    public static function enqueueAssets(): void
    {
        wp_enqueue_style(
            'wpm-popup-css',
            WPM_PLUGIN_URL . 'public/assets/popup.css',
            [],
            '1.0'
        );

        wp_enqueue_script(
            'wpm-popup-js',
            WPM_PLUGIN_URL . 'public/assets/popup.js',
            [],
            '1.0',
            true
        );
    }

    public static function render(): void
    {
        $settings = WPM_Settings::fromWp();
        $rules    = new WPM_PopupRules($settings);

        if (!$rules->shouldShow()) {
            return;
        }

        $data = [
            'description' => $settings->description(),
            'link'        => $settings->link(),
            'image'       => $settings->image(),
            'delay_ms'    => $rules->delayMs(),
        ];

        require WPM_PLUGIN_PATH . 'public/views/popup.php';
    }
}

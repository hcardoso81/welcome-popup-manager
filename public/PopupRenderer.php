<?php

if (!defined('ABSPATH')) {
    exit;
}

final class WPM_PopupRenderer
{
    private static WPM_Settings $settings;
    private static WPM_PopupRules $rules;

    public static function init(): void
    {
        self::$settings = WPM_Settings::fromWp();
        self::$rules    = new WPM_PopupRules(self::$settings);

        add_action('wp', [self::class, 'register']);
    }

    public static function register(): void
    {
        if (!self::$rules->canDisplay()) {
            return;
        }

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
        if (!self::$rules->shouldShow()) {
            return;
        }

        $data = [
            'description' => self::$settings->description(),
            'link'        => self::$settings->link(),
            'image'       => self::$settings->image(),
            'delay_ms'    => self::$rules->delayMs(),
        ];

        require WPM_PLUGIN_PATH . 'public/views/popup.php';
    }
}

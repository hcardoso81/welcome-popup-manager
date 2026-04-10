<?php

namespace WPM1\PublicSite;

if (!defined('ABSPATH')) {
    exit;
}

use WPM1\Domain\Settings;
use WPM1\Domain\PopupRules;

final class PopupRenderer
{
    private static Settings $settings;
    private static PopupRules $rules;

    public static function init(): void
    {
        self::$settings = Settings::fromWp();
        self::$rules    = new PopupRules(self::$settings);

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
            WPM1_PLUGIN_URL . 'public/assets/popup.css',
            [],
            WPM1_PLUGIN_VERSION
        );

        wp_enqueue_script(
            'wpm-popup-js',
            WPM1_PLUGIN_URL . 'public/assets/popup.js',
            [],
            WPM1_PLUGIN_VERSION,
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

        require WPM1_PLUGIN_PATH . 'public/views/popup.php';
    }
}

<?php
// admin/SettingsRegistry.php

namespace WPM\Admin;

use WPM\Domain\SettingsSanitizer;

use WPM\Admin\Fields\EnabledField;
use WPM\Admin\Fields\SettingsStartField;
use WPM\Admin\Fields\DescriptionField;
use WPM\Admin\Fields\LinkField;
use WPM\Admin\Fields\ImageField;
use WPM\Admin\Fields\DelayEnabledField;
use WPM\Admin\Fields\DelaySecondsField;
use WPM\Admin\Fields\DisplayModeField;
use WPM\Admin\Fields\SettingsEndField;

if (!defined('ABSPATH')) {
    exit;
}

class SettingsRegistry
{

    public static function register(): void
    {

        register_setting(
            'wpm_settings_group',
            'wpm_settings',
            ['sanitize_callback' => [SettingsSanitizer::class, 'sanitize']]
        );

        add_settings_section(
            'wpm_main_section',
            'Popup Settings',
            null,
            'welcome-popup-manager'
        );

        self::registerFields();
    }

    private static function registerFields(): void
    {

        add_settings_field(
            'wpm_enabled',
            'Estado',
            [EnabledField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        // ABRIMOS PANEL
        add_settings_field(
            'wpm_start',
            '',
            [SettingsStartField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );


        add_settings_field(
            'wpm_description',
            'Descripción',
            [DescriptionField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_link',
            'Link de la imagen',
            [LinkField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_image',
            'Imagen del popup',
            [ImageField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_delay_enabled',
            'Delay',
            [DelayEnabledField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_delay_seconds',
            'Segundos de delay',
            [DelaySecondsField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_display_mode',
            'Frecuencia de visualización',
            [DisplayModeField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_end',
            '',
            [SettingsEndField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );
    }
}

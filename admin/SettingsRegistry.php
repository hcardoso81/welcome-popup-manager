<?php
// admin/SettingsRegistry.php

if (!defined('ABSPATH')) {
    exit;
}

class WPM_SettingsRegistry
{

    public static function register(): void
    {

        register_setting(
            'wpm_settings_group',
            'wpm_settings',
            ['sanitize_callback' => [WPM_SettingsSanitizer::class, 'sanitize']]
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
            [WPM_EnabledField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        // ABRIMOS PANEL
        add_settings_field(
            'wpm_start',
            '',
            [WPM_SettingsStartField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );


        add_settings_field(
            'wpm_description',
            'Descripción',
            [WPM_DescriptionField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_link',
            'Link de la imagen',
            [WPM_LinkField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_image',
            'Imagen del popup',
            [WPM_ImageField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_delay_enabled',
            'Delay',
            [WPM_DelayEnabledField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_delay_seconds',
            'Segundos de delay',
            [WPM_DelaySecondsField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_display_mode',
            'Frecuencia de visualización',
            [WPM_DisplayModeField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );

        add_settings_field(
            'wpm_end',
            '',
            [WPM_SettingsEndField::class, 'render'],
            'welcome-popup-manager',
            'wpm_main_section'
        );
    }
}

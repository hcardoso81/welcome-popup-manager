<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', 'wpm_add_admin_menu');

function wpm_add_admin_menu() {
    add_menu_page(
        'Welcome Popup Manager',
        'Welcome Popup',
        'manage_options',
        'welcome-popup-manager',
        'wpm_render_settings_page',
        'dashicons-format-image'
    );
}

function wpm_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Welcome Popup Manager</h1>

        <form method="post" action="options.php">
            <?php
                settings_fields('wpm_settings_group');
                do_settings_sections('welcome-popup-manager');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'wpm_register_settings');

function wpm_register_settings() {

    register_setting('wpm_settings_group', 'wpm_settings');

    add_settings_section(
        'wpm_main_section',
        'Popup Settings',
        null,
        'welcome-popup-manager'
    );
}

add_settings_field(
    'wpm_description',
    'Descripción',
    'wpm_description_field_callback',
    'welcome-popup-manager',
    'wpm_main_section'
);

add_settings_field(
    'wpm_link',
    'Link de la imagen',
    'wpm_link_field_callback',
    'welcome-popup-manager',
    'wpm_main_section'
);

function wpm_description_field_callback() {
    $options = get_option('wpm_settings');
    $value = isset($options['description']) ? esc_textarea($options['description']) : '';
    ?>
    <textarea
        name="wpm_settings[description]"
        rows="5"
        cols="50"
        class="large-text"
    ><?php echo $value; ?></textarea>
    <?php
}

function wpm_link_field_callback() {
    $options = get_option('wpm_settings');
    $value = isset($options['link']) ? esc_url($options['link']) : '';
    ?>
    <input
        type="url"
        name="wpm_settings[link]"
        value="<?php echo $value; ?>"
        class="regular-text"
        placeholder="https://ejemplo.com"
    />
    <?php
}




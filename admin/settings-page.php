<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', 'wpm_add_admin_menu');
add_action('admin_init', 'wpm_register_settings');

add_action('admin_enqueue_scripts', 'wpm_admin_scripts');

function wpm_admin_scripts($hook)
{
    if ($hook !== 'toplevel_page_welcome-popup-manager') {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script(
        'wpm-admin-js',
        plugin_dir_url(__FILE__) . 'admin.js',
        ['jquery'],
        '1.0',
        true
    );
}

/**
 * Admin menu
 */
function wpm_add_admin_menu()
{
    add_menu_page(
        'Welcome Popup Manager',
        'Welcome Popup',
        'manage_options',
        'welcome-popup-manager',
        'wpm_render_settings_page',
        'dashicons-format-image'
    );
}

/**
 * Settings page render
 */
function wpm_render_settings_page()
{
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

/**
 * Register settings
 */
function wpm_register_settings()
{

    register_setting('wpm_settings_group', 'wpm_settings', 'wpm_sanitize_settings');

    add_settings_section(
        'wpm_main_section',
        'Popup Settings',
        null,
        'welcome-popup-manager'
    );

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

    add_settings_field(
        'wpm_image',
        'Imagen del popup',
        'wpm_image_field_callback',
        'welcome-popup-manager',
        'wpm_main_section'
    );

    add_settings_field(
        'wpm_delay_enabled',
        'Delay',
        'wpm_delay_enabled_field_callback',
        'welcome-popup-manager',
        'wpm_main_section'
    );

    add_settings_field(
        'wpm_delay_seconds',
        'Segundos de delay',
        'wpm_delay_seconds_field_callback',
        'welcome-popup-manager',
        'wpm_main_section'
    );

    add_settings_field(
    'wpm_display_mode',
    'Frecuencia de visualización',
    'wpm_display_mode_field_callback',
    'welcome-popup-manager',
    'wpm_main_section'
);
}

function wpm_sanitize_settings($input) {
    $output = [];

    $output['description'] = sanitize_textarea_field($input['description'] ?? '');
    $output['link'] = esc_url_raw($input['link'] ?? '');

    $output['delay_enabled'] = isset($input['delay_enabled']) ? '1' : '0';

    $output['delay_seconds'] = isset($input['delay_seconds'])
        ? absint($input['delay_seconds'])
        : 0;

$output['display_mode'] = in_array($input['display_mode'] ?? '', ['auto', 'manual'], true)
    ? $input['display_mode']
    : 'auto';


    return $output;
}


function wpm_get_settings() {
    $defaults = [
        'description'   => '',
        'link'          => '',
        'display_mode'  => 'immediate',
        'delay_seconds' => 5,
        'show_once'     => '1',
        'display_mode' => 'auto',
    ];

    return wp_parse_args(get_option('wpm_settings', []), $defaults);
}

/**
 * Fields
 */
function wpm_description_field_callback()
{
    $options = wpm_get_settings();
    $value = $options['description'] ?? '';
?>
    <textarea
        name="wpm_settings[description]"
        rows="5"
        class="large-text"><?php echo esc_textarea($value); ?></textarea>
<?php
}

function wpm_link_field_callback()
{
    $options = wpm_get_settings();
    $value = $options['link'] ?? '';
?>
    <input
        type="url"
        name="wpm_settings[link]"
        value="<?php echo esc_url($value); ?>"
        class="regular-text"
        placeholder="https://ejemplo.com" />
<?php
}

function wpm_image_field_callback()
{
    $options = wpm_get_settings();
    $image = $options['image'] ?? '';
?>
    <div>
        <input
            type="hidden"
            id="wpm_image"
            name="wpm_settings[image]"
            value="<?php echo esc_url($image); ?>" />

        <button type="button" class="button" id="wpm_image_upload">
            Seleccionar imagen
        </button>

        <div style="margin-top:10px;">
            <img
                id="wpm_image_preview"
                src="<?php echo esc_url($image); ?>"
                style="max-width:200px;<?php echo empty($image) ? 'display:none;' : ''; ?>" />
        </div>
    </div>
<?php
}

function wpm_delay_enabled_field_callback() {
    $options = wpm_get_settings();
    $checked = !empty($options['delay_enabled']);
    ?>
    <label>
        <input
            type="checkbox"
            name="wpm_settings[delay_enabled]"
            value="1"
            <?php checked($checked); ?>
        />
        Mostrar el popup después de un tiempo
    </label>
    <?php
}

function wpm_delay_seconds_field_callback() {
    $options = wpm_get_settings();
    $value = $options['delay_seconds'] ?? 0;
    ?>
    <input
        type="number"
        name="wpm_settings[delay_seconds]"
        value="<?php echo esc_attr($value); ?>"
        min="0"
        step="1"
        class="small-text"
    />
    <span>segundos</span>
    <?php
}

function wpm_display_mode_field_callback() {
    $options = wpm_get_settings();

    $value = $options['display_mode'] ?? 'auto';
    ?>
    <select name="wpm_settings[display_mode]">
        <option value="auto" <?php selected($value, 'auto'); ?>>Automático</option>
        <option value="manual" <?php selected($value, 'manual'); ?>>Manual</option>
    </select>
    <?php
}



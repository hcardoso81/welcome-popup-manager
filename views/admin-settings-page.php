<?php
// views/admin-settings-page.php
/**
 * Admin Settings Page View
 *
 * @var void
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1>Welcome Popup Manager</h1>

    <form method="post" action="options.php">
        <?php settings_fields('wpm_settings_group'); ?>

        <?php do_settings_sections('welcome-popup-manager'); ?>

        <div id="wpm-settings-options">
            <?php do_settings_sections('wpm_popup_options'); ?>
        </div>

        <?php submit_button(); ?>
    </form>
</div>


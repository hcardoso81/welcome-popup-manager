<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div
    id="wpm-overlay"
    class="wpm-overlay"
    style="display:none;"
>
    <div
        class="wpm-popup"
        data-delay="<?php echo esc_attr($data['delay_ms']); ?>"
    >
        <button class="wpm-close" aria-label="Cerrar">&times;</button>

        <div class="wpm-popup-content">
            <?php if (!empty($data['description'])): ?>
                <p class="wpm-popup-description">
                    <?php echo esc_html($data['description']); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($data['image'])): ?>
                <a href="<?php echo esc_url($data['link']); ?>">
                    <img
                        src="<?php echo esc_url($data['image']); ?>"
                        alt=""
                    />
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

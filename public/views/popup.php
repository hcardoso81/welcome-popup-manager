<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div id="wpm-overlay" class="wpm-overlay" style="display:none;">
    <div
        class="wpm-modal"
        data-delay="<?php echo esc_attr($data['delay_ms']); ?>"
        role="dialog"
        aria-modal="true"
    >
        <button class="wpm-close" aria-label="Cerrar">&times;</button>

        <div class="wpm-modal-content">
            <?php if (!empty($data['description'])): ?>
                <p class="wpm-description">
                    <?php echo esc_html($data['description']); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($data['image'])): ?>
                <a href="<?php echo esc_url($data['link']); ?>">
                    <img src="<?php echo esc_url($data['image']); ?>" alt="" />
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<div id="wpm-overlay" class="wpm-hidden"></div>

<div id="wpm-popup" class="wpm-hidden">
    <button id="wpm-close">&times;</button>

    <?php if (!empty($settings['description'])): ?>
        <div class="wpm-description">
            <?php echo esc_html($settings['description']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($settings['image'])): ?>
        <a href="<?php echo esc_url($settings['link']); ?>">
            <img src="<?php echo esc_url($settings['image']); ?>" alt="">
        </a>
    <?php endif; ?>
</div>

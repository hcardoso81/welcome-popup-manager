<?php

namespace WPM1\Bootstrap;

if (!defined('ABSPATH')) {
    exit;
}

require_once WPM1_PLUGIN_PATH . 'domain/Settings.php';
require_once WPM1_PLUGIN_PATH . 'domain/PopupRules.php';
require_once WPM1_PLUGIN_PATH . 'public/PopupRenderer.php';

use WPM1\PublicSite\PopupRenderer;

PopupRenderer::init();

<?php

namespace WPM\Bootstrap;

if (!defined('ABSPATH')) {
    exit;
}

require_once WPM_PLUGIN_PATH . 'domain/Settings.php';
require_once WPM_PLUGIN_PATH . 'domain/PopupRules.php';
require_once WPM_PLUGIN_PATH . 'public/PopupRenderer.php';

use WPM\PublicSite\PopupRenderer;

PopupRenderer::init();

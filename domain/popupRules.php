<?php

if (!defined('ABSPATH')) {
    exit;
}

final class WPM_PopupRules
{
    private WPM_Settings $settings;

    public function __construct(WPM_Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Regla principal
     */
    public function shouldShow(): bool
    {
        if ($this->hasNoImage()) {
            return false;
        }

        if ($this->isManualMode() && $this->wasAlreadyShown()) {
            return false;
        }

        return true;
    }

    /**
     * Delay en milisegundos (para JS)
     */
    public function delayMs(): int
    {
        if (!$this->settings->delayEnabled()) {
            return 0;
        }

        return $this->settings->delaySeconds() * 1000;
    }

    /* ======================
       Reglas privadas
       ====================== */

    private function hasNoImage(): bool
    {
        return empty($this->settings->image());
    }

    private function isManualMode(): bool
    {
        return $this->settings->displayMode() === 'manual';
    }

    /**
     * ⚠️ Esta es la ÚNICA dependencia técnica
     * Podría abstraerse luego si querés
     */
    private function wasAlreadyShown(): bool
    {
        return isset($_COOKIE['wpm_popup_shown']);
    }
}

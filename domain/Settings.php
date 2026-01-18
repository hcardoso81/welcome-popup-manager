<?php

if (!defined('ABSPATH')) {
    exit;
}

final class WPM_Settings
{
    private array $values;

    private function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * Factory desde WordPress
     */
    public static function fromWp(): self
    {
        $stored = get_option('wpm_settings', []);

        return new self(
            wp_parse_args($stored, self::defaults())
        );
    }

    /**
     * Defaults del dominio
     */
    public static function defaults(): array
    {
        return [
            'description'   => '',
            'link'          => '',
            'image'         => '',
            'delay_enabled' => false,
            'delay_seconds' => 5,
            'display_mode'  => 'auto', // auto | manual
        ];
    }

    /* ======================
       Getters del dominio
       ====================== */

    public function description(): string
    {
        return (string) $this->values['description'];
    }

    public function link(): string
    {
        return (string) $this->values['link'];
    }

    public function image(): string
    {
        return (string) $this->values['image'];
    }

    public function delayEnabled(): bool
    {
        return (bool) $this->values['delay_enabled'];
    }

    public function delaySeconds(): int
    {
        return (int) $this->values['delay_seconds'];
    }

    public function displayMode(): string
    {
        return $this->values['display_mode'];
    }
}

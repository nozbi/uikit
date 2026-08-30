<?php

namespace Nozbi\Uikit;

final class StyleExecutor
{
    private static array $styles = [];

    public static function execute(string $css): void
    {
        self::$styles[] = $css;
    }

    public static function render(): string
    {
        if (empty(self::$styles)) {
            return '';
        }

        $css = '';

        foreach (self::$styles as $style) {
            $css .= $style . "\n";
        }

        self::$styles = [];

        return '<style>' . $css . '</style>';
    }
}
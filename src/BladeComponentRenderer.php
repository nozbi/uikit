<?php

namespace Nozbi\Uikit;

use Illuminate\Support\Facades\Blade;

class BladeComponentRenderer
{
    public static function render(string $name, array $attributes = [], array $slots = []): string
    {
        $attrString = '';
        $bindings = [];
        foreach ($attributes as $key => $value) 
        {
            if ($value === null) continue;
            $bindings[$key] = $value;
            $attrString .= " :{$key}=\"\${$key}\"";
        }
        $slotString = '';
        foreach ($slots as $slotName => $slotContent) 
        {
            $slotString .= "<x-slot name=\"{$slotName}\">{$slotContent}</x-slot>";
        }
        $bladeString = "<x-{$name}{$attrString}>{$slotString}</x-{$name}>";
        return Blade::render($bladeString, $bindings);
    }
}
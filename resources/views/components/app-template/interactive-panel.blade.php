@props([
    'color',
    'backgroundColor',
    'padding' => null,
    'paddingTop' => 0,
    'paddingBottom' => 0,
    'paddingLeft' => 0,
    'paddingRight' => 0,
    'transparent' => false,
])

@php
    $opacity = 100;
    if ($transparent)
    {
        $opacity = 0;
    }
@endphp

<x-uikit::app-template.interactive-panel-base :color="$color" :opacity="$opacity">
    <x-uikit::app-template.background :color="$backgroundColor" :padding="$padding" :padding-top="$paddingTop" :padding-bottom="$paddingBottom" :padding-left="$paddingLeft" :padding-right="$paddingRight">
        {{ $slot }}
    </x-uikit::app-template.background>
</x-uikit::app-template.interactive-panel-base>  
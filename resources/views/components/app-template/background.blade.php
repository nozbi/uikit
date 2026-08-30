@props([
    'color',
    'padding' => null,
    'paddingTop' => 0,
    'paddingBottom' => 0,
    'paddingLeft' => 0,
    'paddingRight' => 0,
])

@php
    if ($padding)
    {
        $paddingTop = $padding;
        $paddingBottom = $padding;
        $paddingLeft = $padding;
        $paddingRight = $padding;
    }
@endphp

<x-uikit::panels.fill-panel>
    <div style="background-color:{{ $color }}; padding-top:{{ $paddingTop }}px; padding-bottom:{{ $paddingBottom }}px; padding-left:{{ $paddingLeft }}px; padding-right:{{ $paddingRight }}px;">
        <x-uikit::panels.fill-panel>
            {{ $slot }}
        </x-uikit::panels.fill-panel>
    </div>
</x-uikit::panels.fill-panel> 
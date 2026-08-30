@props([
    'width' => null,
    'height' => null,
])

@php
    $style = "";
    if ($width === null)
    {
        $style .= "width:100%;";
    }
    else 
    {
        $style .= "width:{$width}px;";
    }
    if ($height === null)
    {
        $style .= "height:100%;";
    }
    else 
    {
        $style .= "height:{$height}px;";
    }
@endphp

<div style="{{ $style }}">
    <x-uikit::panels.fill-panel>
        {{ $slot }}
    </x-uikit::panels.fill-panel>
</div>

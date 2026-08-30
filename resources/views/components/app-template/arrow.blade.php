@props(['direction'])

@php
    $rotation = match($direction) {
        'right' => '0deg',
        'down'  => '90deg',
        'left'  => '180deg',
        'up'    => '270deg',
        default => '0deg'
    };
@endphp

<svg class="uikit-app-template-arrow" width="24" height="24" viewBox="0 0 24 24" style="transform: rotate({{ $rotation }});">
    <polyline 
        points="6,4 18,12 6,20" 
        fill="none" 
        stroke="currentColor" 
        stroke-width="2" 
        stroke-linecap="round" 
        stroke-linejoin="round" 
    />
</svg>

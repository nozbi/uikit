@props([
    'color' => 'black',
    'opacity' => 100,
    'hoveredOpacity' => 50,
    'pressedOpacity' => 25,
])

@php 
    use Nozbi\Uikit\AppTemplate;

    $uid = uniqid('btn_');
    $baseColor = $color;
    $color = AppTemplate::getColorWithOpacity($baseColor, $opacity);
    $hoveredColor = AppTemplate::getColorWithOpacity($baseColor, $hoveredOpacity);
    $pressedColor = AppTemplate::getColorWithOpacity($baseColor, $pressedOpacity);
@endphp

<div
    id="{{ $uid }}"
    data-color="{{ $color }}"
    data-hovered-color="{{ $hoveredColor }}"
    data-pressed-color="{{ $pressedColor }}"
    style="color:{{ $color }};"
    onpointerenter="appTemplate.handleEnter(this)"
    onpointerleave="appTemplate.handleLeave(this)"
    onpointerdown="appTemplate.handleDown(this)"
    onfocus="appTemplate.handleFocus(this)"
    onblur="appTemplate.handleBlur(this)"
    onkeydown="appTemplate.handleKeyboardEvent(this, event)"
    onkeyup="appTemplate.handleKeyboardEvent(this, event)"
>
    {{ $slot }}
</div>
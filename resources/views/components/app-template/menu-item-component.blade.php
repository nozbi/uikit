@props([
    'depth',
    'isToggle',
    'isToggled',
    'isActive',
    'label',

    'color',
    'activeColor',
    'baseFontSize',
    'leftPadding',
    'rightPadding',
])

@php
    $baseSpacing = 5;
    $baseLeftMargin = 40;
    $baseArrowSize = $baseFontSize;
    $baseDepthRatio = 0.8;
    $depthRatio = pow($baseDepthRatio, min(2, $depth));
    $spacing = $depthRatio * $baseSpacing;
    $fontSize = $depthRatio * $baseFontSize;
    $arrowSize = $depthRatio * $baseArrowSize;
    $leftMargin = 0;
    for ($i = 1; $i <= $depth; $i++)
    {
        $leftMargin += $baseLeftMargin * pow($baseDepthRatio, min(2, $i));;
    }
    $leftPadding += $leftMargin;
    $topPadding = $spacing;
    $bottomPadding = $spacing;
    $direction = 'right';
    if ($isToggle && $isToggled)
    {
        $direction = 'down';
    }
    if ($isActive && (!$isToggle || !$isToggled))
    {
        $color = $activeColor;
    }
@endphp

@if ($isToggle)
    <x-uikit::app-template.interactive-panel :color="$color" :backgroundColor="'transparent'" :padding-left="$leftPadding" :padding-right="$rightPadding" :padding-top="$topPadding" :padding-bottom="$bottomPadding">
        <x-uikit::panels.right-edge-panel>
            <x-slot name="slot">
                <div style="font-size:{{ $fontSize }}px;">
                    {{ $label }}
                </div>
            </x-slot> 
            <x-slot name="edge">
                <x-uikit::panels.size-panel :width="$baseArrowSize" :height="$arrowSize">
                    <x-uikit::app-template.arrow :direction="$direction"/>
                </x-uikit::panels.size-panel>
            </x-slot> 
        </x-uikit::panels.right-edge-panel>
    </x-uikit::app-template.interactive-panel>
@else
    <x-uikit::app-template.interactive-panel :color="$color" :backgroundColor="'transparent'" :padding-left="$leftPadding" :padding-right="$rightPadding" :padding-top="$topPadding" :padding-bottom="$bottomPadding">
        <div style="font-size:{{ $fontSize }}px;">    
            {{ $label }}
        </div>
    </x-uikit::app-template.interactive-panel>
@endif


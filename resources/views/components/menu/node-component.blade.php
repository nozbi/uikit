@props([
    'depth',
    'isToggle',
    'isToggled',
    'menuItemComponent',
    'route',
    'livewire',
    'menuItemAttributes'
])

@php
    use Nozbi\Uikit\BladeComponentRenderer;

    $menuItemAttributes['depth'] = $depth;
    $menuItemAttributes['isToggle'] = $isToggle;
    if ($isToggle)
    {
        $menuItemAttributes['isToggled'] = $isToggled;
    }
    $renderedNode = BladeComponentRenderer::render($menuItemComponent, $menuItemAttributes);
@endphp

@if ($isToggle)
    {!! $renderedNode !!}
@else
    <x-uikit::buttons.link :route="$route" :livewire="$livewire">
        <x-slot name="slot">
            {!! $renderedNode !!}
        </x-slot>
    </x-uikit::buttons.link>
@endif
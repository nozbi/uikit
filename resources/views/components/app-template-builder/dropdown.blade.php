@props([
    'width',
    'maxMobileWidth'
])

@php
    $buttonId = 'custom-dropdown' . uniqid();
    $dropdownId = 'custom-dropdown' . uniqid();
    $onToggled = "appTemplateBuilder.toggle('$dropdownId', '$buttonId', '$maxMobileWidth')";
    $onUntoggled = "appTemplateBuilder.untoggle('$dropdownId')";
    Nozbi\Uikit\ScriptExecutor::execute('appTemplateBuilder.init', $dropdownId, $buttonId);
@endphp

<div id="{{ $buttonId }}" class="uikit-app-template-builder-dropdown-button">
    <x-uikit::buttons.toggle :on-toggled="$onToggled" :on-untoggled="$onUntoggled">
        <x-slot name="slot">
            {{ $toggleSlot }}
        </x-slot>
        <x-slot name="toggledSlot">
            {{ $toggledToggleSlot }}
        </x-slot>
    </x-uikit::buttons.toggle>
</div>

<div id="{{ $dropdownId }}" class="uikit-app-template-builder-dropdown-panel" style="width:{{ $width }}px;">
    {{ $slot }}
</div>
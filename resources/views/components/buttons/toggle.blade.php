@props([
    'onToggled' => '',
    'onUntoggled' => '',
    'toggled' => false,
])

@php
    $untoggledHideablePanelId = 'toggle-' . uniqid();
    $toggledHideablePanelId = 'toggle-' . uniqid();
    $onToggledJs = json_encode($onToggled);
    $onUntoggledJs = json_encode($onUntoggled);
    $onClicked = "buttons.onClicked('$untoggledHideablePanelId', '$toggledHideablePanelId', $onToggledJs, $onUntoggledJs)";
@endphp

@php
    $untoggledDisplayStyle = 'display:none;';
    $toggledDisplayStyle = 'display:none;';
    if ($toggled) 
    {
        $toggledDisplayStyle = '';
    }
    else
    {
        $untoggledDisplayStyle = '';
    }
@endphp

<x-uikit::buttons.button :on-clicked="$onClicked">
    <div id="{{ $untoggledHideablePanelId }}" style="{{ $untoggledDisplayStyle }}">
        <x-uikit::buttons.events-propagator :source-offset="4">
            {{ $slot }}
        </x-uikit::buttons.events-propagator> 
    </div>
    <div id="{{ $toggledHideablePanelId }}" style="{{ $toggledDisplayStyle }}">
        <x-uikit::buttons.events-propagator :source-offset="4">
            {{ $toggledSlot ?? $slot }}
        </x-uikit::buttons.events-propagator> 
    </div>
</x-uikit::buttons.button>

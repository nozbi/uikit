@props([
    'onClicked' => '',
])

<x-uikit::buttons.fill-panel>
    <button class="uikit-buttons-button" onclick="{{ $onClicked }}" type="button">
        <x-uikit::buttons.events-propagator>
            {{ $slot }}
        </x-uikit::buttons.events-propagator>
    </button>
</x-uikit::buttons.fill-panel>

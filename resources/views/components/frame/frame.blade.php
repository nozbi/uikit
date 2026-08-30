@props([
    'localStorageKey' => null,
    'minSlotWidth' => 0,
    'sideBarWidth',
    'topBarHeight',
])

<x-uikit::frame.responsive-frame :local-storage-key="$localStorageKey" :side-bar-width="$sideBarWidth" :min-slot-width="$minSlotWidth" :top-bar-height="$topBarHeight">
    <x-slot name="toggleSlot">
        {{ $toggleSlot }}
    </x-slot>
    <x-slot name="toggledToggleSlot">
        {{ $toggledToggleSlot }}
    </x-slot>
    <x-slot name="topBarSlot">
        {{ $topBarSlot }}
    </x-slot>
    <x-slot name="sideBarSlot">
        {{ $sideBarSlot }}
    </x-slot>
    <x-slot name="slot">
        {{ $slot }}
    </x-slot>
</x-uikit::frame.responsive-frame>

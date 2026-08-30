@props([
    'menuItems',
    'menuItemComponent',
    'menuBarHeight',
    'livewire',
    'sideBarWidth',
    'topBarHeight',
    'localStorageKey',
])

@php
    $menuLocalStorageKey = null;
    $framelocalStorageKey = null;
    if ($localStorageKey)
    {
        $menuLocalStorageKey = $localStorageKey . '-menu';
        $framelocalStorageKey = $localStorageKey . '-frame';
    }
@endphp

<div class="uikit-app-template-builder-base-app-template">
    <x-uikit::frame.frame :min-slot-width="320" :side-bar-width="$sideBarWidth" :top-bar-height="$topBarHeight" :local-storage-key="$framelocalStorageKey" >
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
            <x-uikit::menu.menu :menu-items="$menuItems" :menu-item-component="$menuItemComponent" :bar-height="$menuBarHeight" :local-storage-key="$menuLocalStorageKey" :livewire="$livewire">
                <x-slot name="searchBarSlot">
                    {{ $searchBarSlot }}
                </x-slot>
                <x-slot name="collapseButtonSlot">
                    {{ $collapseButtonSlot }}
                </x-slot>
                <x-slot name="expandButtonSlot">
                    {{ $expandButtonSlot }}
                </x-slot>
            </x-uikit::menu.menu>
        </x-slot>
        <x-slot name="slot">
            {{ $slot }}
        </x-slot>
    </x-uikit::frame.frame>
</div>
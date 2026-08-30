@props([
    'sideBarMenuItems',
    'sideBarMenuItemComponent',
    'sideBarMenuBarHeight',
    'livewire' => false,
    'sideBarWidth',
    'topBarHeight',
    'localStorageKey' => null,
    'dropdownMenuItems',
    'dropdownMenuItemComponent',
    'dropdownWidth'
])

@php
    $maxMobileWidth = $sideBarWidth + 320;
@endphp

<x-uikit::app-template-builder.base-app-template  
    :menu-items="$sideBarMenuItems" 
    :menu-item-component="$sideBarMenuItemComponent" 
    :menu-bar-height="$sideBarMenuBarHeight"
    :livewire="$livewire"
    :top-bar-height="$topBarHeight"
    :side-bar-width="$sideBarWidth"
    :local-storage-key="$localStorageKey"
>
    <x-slot name="toggleSlot">
        <div id="uikit-app-template-builder-side-bar-toggle-slot">
            {{ $sideBarToggleSlot }}
        </div>
    </x-slot>
    <x-slot name="toggledToggleSlot">
        {{ $sideBarToggledToggleSlot ?? $sideBarToggleSlot }}
    </x-slot>
    <x-slot name="topBarSlot">
        @if (isset($dropdownToggleSlot))
            <x-uikit::app-template-builder.bar 
                :height="$topBarHeight"
                :menu-items="$dropdownMenuItems" 
                :menu-item-component="$dropdownMenuItemComponent" 
                :livewire="$livewire"
                :dropdown-width="$dropdownWidth"
                :max-mobile-width="$maxMobileWidth"
            >
                <x-slot name="slot">
                    {{ $topBarSlot }}
                </x-slot>
                <x-slot name="toggleSlot">
                    {{ $dropdownToggleSlot }}
                </x-slot>
                <x-slot name="toggledToggleSlot">
                    {{ $dropdownToggledToggleSlot ?? $dropdownToggleSlot}}
                </x-slot>
            </x-uikit::app-template-builder.bar> 
        @else
            {{ $topBarSlot }}
        @endif
    </x-slot>
    <x-slot name="searchBarSlot">
        {{ $sideBarMenuSearchBarSlot }}
    </x-slot>
    <x-slot name="collapseButtonSlot">
        {{ $sideBarMenuCollapseButtonSlot }}
    </x-slot>
    <x-slot name="expandButtonSlot">
        {{ $sideBarMenuExpandButtonSlot }}
    </x-slot>
    <x-slot name="slot">
        {{ $slot }}
    </x-slot>
</x-uikit::app-template-builder.base-app-template>
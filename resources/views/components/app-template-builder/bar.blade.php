@props([
    'height',
    'menuItems',
    'menuItemComponent',
    'livewire',
    'dropdownWidth',
    'maxMobileWidth'
])

<x-uikit::panels.right-edge-panel>
    <x-slot name="slot">
        {{ $slot }}
    </x-slot>
    <x-slot name="edge">
        <x-uikit::panels.size-panel :width="$height" :height="$height">
            <x-uikit::app-template-builder.dropdown :width="$dropdownWidth" :max-mobile-width="$maxMobileWidth">
                <x-slot name="toggleSlot">
                    {{ $toggleSlot }}
                </x-slot>
                <x-slot name="toggledToggleSlot">
                    {{ $toggledToggleSlot }}
                </x-slot>
                <x-slot name="slot">
                    <x-uikit::menu.menu :menu-items="$menuItems" :menu-item-component="$menuItemComponent" :bar-height="0" :livewire="$livewire">
                        <x-slot name="searchBarSlot"></x-slot>
                        <x-slot name="collapseButtonSlot"></x-slot>
                        <x-slot name="expandButtonSlot"></x-slot>
                    </x-uikit::menu.menu>
                </x-slot>
            </x-uikit::app-template-builder.dropdown>
        </x-uikit::panels.size-panel>
    </x-slot>
</x-uikit::panels.right-edge-panel>

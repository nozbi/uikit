@props([
    'localStorageKey',
    'topBarHeight',
])

@php
    $sidebarId = 'customFrame_' . uniqid();
    $toggleId = 'customFrame_' . uniqid();
    $onToggled = "frame.showSidebar('$sidebarId', '$localStorageKey')";
    $onUntoggled = "frame.hideSidebar('$sidebarId', '$localStorageKey')";
    Nozbi\Uikit\ScriptExecutor::execute('frame.restoreSidebarVisibility', $sidebarId, $localStorageKey, $toggleId);
@endphp

<x-uikit::panels.antiflicker-panel>
    <x-uikit::frame.base-frame :top-bar-height="$topBarHeight">
        <x-slot name="toggleSlot">
            <div id="{{ $toggleId }}">
                <x-uikit::panels.fill-panel>
                    <x-uikit::buttons.toggle :on-toggled="$onToggled" :on-untoggled="$onUntoggled">
                        <x-slot name="slot">
                            {{ $toggleSlot }}
                        </x-slot>
                        <x-slot name="toggledSlot">
                            {{ $toggledToggleSlot }}
                        </x-slot>
                    </x-uikit::buttons.toggle>
                </x-uikit::panels.fill-panel>
            </div>
        </x-slot>
        <x-slot name="topBarSlot">
            {{ $topBarSlot }}
        </x-slot>
        <x-slot name="sideBarSlot">
            <div class="uikit-frame-interactive-frame-sidebar" id="{{ $sidebarId }}">
                <x-uikit::panels.fill-panel>
                    {{ $sideBarSlot }}
                </x-uikit::panels.fill-panel>
            </div>
        </x-slot>
        <x-slot name="slot">
            {{ $slot }}
        </x-slot>
    </x-uikit::frame.base-frame>
</x-uikit::panels.antiflicker-panel>
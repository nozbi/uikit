@props([
    'localStorageKey',
    'sideBarWidth',
    'minSlotWidth',
    'topBarHeight',
])

@php
    $rootId = 'custom-frame-' . uniqid();
    $sideBarId = 'custom-frame-' . uniqid();
    $minSplitWidth = $sideBarWidth + $minSlotWidth;
    if ($localStorageKey)
    {
        Nozbi\Uikit\ScriptExecutor::execute('frame.blockStateRestoreIfMobile', $rootId, $minSplitWidth, $localStorageKey);
    }
@endphp

@php
\Nozbi\Uikit\StyleExecutor::execute("
    @container (max-width: {$minSplitWidth}px) {
        #{$sideBarId} {
            width: 100cqw;
        }
    }
");
@endphp

<x-uikit::panels.fill-panel>
    <div
        id="{{ $rootId }}"
        class="uikit-frame-responsive-frame-root"
        style="--uikit-frame-min-split-width: {{ $minSplitWidth }}px;"
    >
        <x-uikit::frame.interactive-frame :local-storage-key="$localStorageKey" :top-bar-height="$topBarHeight">
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
                <div
                    id="{{ $sideBarId }}"
                    class="uikit-frame-responsive-frame-sidebar"
                    style="--uikit-frame-sidebar-width: {{ $sideBarWidth }}px;"
                >
                    <x-uikit::panels.fill-panel>
                        {{ $sideBarSlot }}
                    </x-uikit::panels.fill-panel>
                </div>
            </x-slot>
            <x-slot name="slot">
                {{ $slot }}
            </x-slot>
        </x-uikit::frame.interactive-frame>
    </div>
</x-uikit::panels.fill-panel>
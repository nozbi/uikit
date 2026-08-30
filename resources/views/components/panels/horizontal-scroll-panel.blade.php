@props([
    'localStorageKey' => null
])

<x-uikit::scroll-panel.scroll-panel :vertical="false" :horizontal="true" :local-storage-key="$localStorageKey">
    <x-uikit::panels.horizontal-panel>
        {{ $slot }}
    </x-uikit::panels.horizontal-panel>
</x-uikit::scroll-panel.scroll-panel>

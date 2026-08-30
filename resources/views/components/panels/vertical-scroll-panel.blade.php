@props([
    'localStorageKey' => null
])

<x-uikit::scroll-panel.scroll-panel :vertical="true" :horizontal="false" :local-storage-key="$localStorageKey">
    <x-uikit::panels.vertical-panel>
        {{ $slot }}
    </x-uikit::panels.vertical-panel>
</x-uikit::scroll-panel.scroll-panel>

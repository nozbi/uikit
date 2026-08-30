@props([
    'nodes',
    'nodeComponent',
    'barHeight',
    'localStorageKey' => null
])

@php
    $id = 'customSearchableTree-' . uniqid();
    $barLocalStorageKey = null;
    $scrollPaneelLocalStorageKey = null;
    if ($localStorageKey)
    {
        $barLocalStorageKey = $localStorageKey . '-bar';
        $scrollPaneelLocalStorageKey = $localStorageKey . 'scroll-panel';
    }
@endphp

<x-uikit::panels.top-edge-panel>
    <x-slot name="edge">
        <x-uikit::searchable-tree-builder.bar :tree-id="$id" :height="$barHeight" :local-storage-key="$barLocalStorageKey">
            <x-slot name="searchBarSlot">
                {{ $searchBarSlot }}
            </x-slot>
            <x-slot name="expandButtonSlot">
                {{ $expandButtonSlot }}
            </x-slot>
            <x-slot name="collapseButtonSlot">
                {{ $collapseButtonSlot }}
            </x-slot>
        </x-uikit::searchable-tree-builder.bar>
    </x-slot>
    <x-slot name="slot">
        <x-uikit::panels.vertical-scroll-panel :local-storage-key="$scrollPaneelLocalStorageKey">
            <x-uikit::searchable-tree-builder.internal-tree :id="$id" :nodes="$nodes" :node-component="$nodeComponent"/> 
        </x-uikit::panels.vertical-scroll-panel>
    </x-slot>
</x-uikit::panels.top-edge-panel>
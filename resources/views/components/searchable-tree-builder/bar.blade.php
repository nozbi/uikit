@props([
    'treeId',
    'height',
    'localStorageKey'
])

<x-uikit::panels.size-panel :height="$height">
    <x-uikit::panels.right-edge-panel>
        <x-slot name="slot">
            <x-uikit::searchable-tree-builder.search-bar :tree-id="$treeId" :local-storage-key="$localStorageKey">
                {{ $searchBarSlot }}
            </x-uikit::searchable-tree-builder.search-bar>
        </x-slot>
        <x-slot name="edge">
            <x-uikit::panels.size-panel :width="$height / 2">
                <x-uikit::panels.vertical-split-panel>
                    <x-slot name="top">
                        <x-uikit::searchable-tree-builder.control-button :tree-id="$treeId" :for-expanding="false">
                            {{ $collapseButtonSlot }}
                        </x-uikit::searchable-tree-builder.control-button>
                    </x-slot>
                    <x-slot name="bottom">
                        <x-uikit::searchable-tree-builder.control-button :tree-id="$treeId" :for-expanding="true">
                            {{ $expandButtonSlot }}
                        </x-uikit::searchable-tree-builder.control-button>
                    </x-slot>
                </x-uikit::panels.vertical-split-panel>
            </x-uikit::panels.size-panel>
        </x-slot>
    </x-uikit::panels.right-edge-panel>
</x-uikit::panels.size-panel>
@props([
    'treeId',
    'forExpanding'
])

@php
    $onClicked = "searchableTreeBuilder.collapseAll('{$treeId}')";
    if ($forExpanding)
    {
        $onClicked = "searchableTreeBuilder.expandAll('{$treeId}')";
    }
@endphp

<x-uikit::buttons.button :on-clicked="$onClicked">
    {{ $slot }}
</x-uikit::buttons.button>
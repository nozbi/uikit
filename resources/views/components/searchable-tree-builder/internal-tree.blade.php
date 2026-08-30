@props([
    'id',
    'nodes',
    'nodeComponent',
])

<div class="uikit-searchable-tree-internal-tree" id="{{ $id }}">
    <x-uikit::tree-builder.tree :nodes="$nodes" :node-component="$nodeComponent"/>
</div>
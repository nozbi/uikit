@props([
    'nodes',
])

@php
    use Nozbi\Uikit\Tree;
    
    $wrappedNodes = Tree::wrapNodesForPersistingInteractiveTree($nodes);
@endphp

<x-uikit::panels.antiflicker-panel>
    <x-uikit::tree.interactive-tree :nodes="$wrappedNodes"/>
</x-uikit::panels.antiflicker-panel>

@props([
    'menuItems',
    'menuItemComponent',
    'barHeight',
    'localStorageKey' => null,
    'livewire' => false
])

@php
    use Nozbi\Uikit\Menu;
@endphp

<x-uikit::searchable-tree-builder.tree :nodes="Menu::transformToNodes($menuItems, $menuItemComponent, $livewire)" :node-component="'uikit::menu.node-component'" :bar-height="$barHeight" :local-storage-key="$localStorageKey"> 
    <x-slot name="searchBarSlot">
        {{ $searchBarSlot }}
    </x-slot>
    <x-slot name="expandButtonSlot">
        {{ $expandButtonSlot }}
    </x-slot>
    <x-slot name="collapseButtonSlot">
        {{ $collapseButtonSlot }}
    </x-slot>
</x-uikit::searchable-tree-builder.search-bar>
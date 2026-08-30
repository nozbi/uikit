@props([
    'subtreeId',
    'isToggled'
])

@php
    $onToggled = "tree.showSubtree('$subtreeId')";
    $onUntoggled="tree.hideSubtree('$subtreeId')";
@endphp

<x-uikit::buttons.toggle :toggled="$isToggled" :on-toggled="$onToggled" :on-untoggled="$onUntoggled">
    <x-slot :name="'slot'">
        {{ $slot }}
    </x-slot>
    <x-slot :name="'toggledSlot'">
        {{ $toggledSlot }}
    </x-slot>
</x-uikit::buttons.toggle>

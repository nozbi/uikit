<x-uikit::layout.horizontal-flex-layout>
    <x-uikit::layout.flex-layout-grow-item>
        {{ $slot }}
    </x-uikit::layout.flex-layout-grow-item>
    <x-uikit::layout.flex-layout-shrink-item>
        {{ $edge }}
    </x-uikit::layout.flex-layout-shrink-item>
</x-uikit::layout.horizontal-flex-layout>
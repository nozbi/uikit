@props([
    'ratio' => 0.5,
])

@php
    $leftWidth = $ratio * 100;
    $rightWidth = 100 - $leftWidth;
@endphp

<x-uikit::panels.fill-panel>
    <div class="uikit-panels-horizontal-split-panel" style="grid-template-columns:{{ $leftWidth }}%{{ $rightWidth }}%;">
        <div>
            <x-uikit::panels.fill-panel>
                {{ $left }}
            </x-uikit::panels.fill-panel>
        </div>
        <div>
            <x-uikit::panels.fill-panel>
                {{ $right }}
            </x-uikit::panels.fill-panel>
        </div>
    </div>
</x-uikit::panels.fill-panel>

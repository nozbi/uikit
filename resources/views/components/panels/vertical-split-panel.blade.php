@props([
    'ratio' => 0.5,
])

@php
    $topHeight = $ratio * 100;
    $bottomHeight = 100 - $topHeight;
@endphp

<x-uikit::panels.fill-panel>
    <div class="uikit-panels-vertical-split-panel" style="grid-template-rows:{{ $topHeight }}%{{ $bottomHeight }}%;">
        <div>
            <x-uikit::panels.fill-panel>
                {{ $top }}
            </x-uikit::panels.fill-panel>
        </div>
        <div>
            <x-uikit::panels.fill-panel>
                {{ $bottom }}
            </x-uikit::panels.fill-panel>
        </div>
    </div>
</x-uikit::panels.fill-panel>

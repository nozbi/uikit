@props([
    'sourceOffset' => 0,
    'targetOffset' => 0,
])

@php
    $id = 'customComponents-' . uniqid();
    Nozbi\Uikit\ScriptExecutor::execute('buttons.addListeners', $id, $sourceOffset, $targetOffset);
@endphp

<x-uikit::buttons.fill-panel>
    <div id="{{ $id }}">
        <x-uikit::buttons.fill-panel>
            {{ $slot }}
        </x-uikit::buttons.fill-panel>
    </div>
</x-uikit::buttons.fill-panel>
@props([
    'localStorageKey',
    'isToggled'
])

@php
    $id = 'custom-tree-' . uniqid();
    $divId = 'custom-tree-' . uniqid();
    Nozbi\Uikit\ScriptExecutor::execute('tree.init', $divId, $localStorageKey, $id, $isToggled);
@endphp

<div id="{{ $divId }}">
    {{ $slot }}
</div>

@props([
    'treeId',
    'localStorageKey'
])

@php
    $id = 'uikit-search-bar' . uniqid();
    $oninput = '';
    if ($localStorageKey)
    {
        Nozbi\Uikit\ScriptExecutor::execute('searchableTreeBuilder.restoreSearchBar', $id, $localStorageKey, $treeId);
    }
@endphp

<x-uikit::buttons.fill-panel>
    <div id="{{ $id }}" oninput="searchableTreeBuilder.search(event, '{{ $treeId }}', '{{ $id }}', '{{ $localStorageKey }}')">
        <x-uikit::buttons.fill-panel>
            {{ $slot }}
        </x-uikit::buttons.fill-panel>
    </div>
</x-uikit::buttons.fill-panel>
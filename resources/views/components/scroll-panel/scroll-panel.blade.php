@props([
    'vertical' => true,
    'horizontal' => true,
    'localStorageKey' => null
])

@php
    $id = 'scroll-panel-' . uniqid();
    $overflowY = $vertical ? 'auto' : 'hidden';
    $overflowX = $horizontal ? 'auto' : 'hidden';
    $visibility = 'visible';
    if ($localStorageKey)
    {
        $visibility = 'hidden';
        Nozbi\Uikit\ScriptExecutor::execute('scrollPanel.init', $id, $localStorageKey);
    }
@endphp

<div class="uikit-scroll-panel" id="{{ $id }}" style="overflow-y:{{ $overflowY }}; overflow-x:{{ $overflowX }}; visibility:{{ $visibility }};">
    {{ $slot }}
</div>
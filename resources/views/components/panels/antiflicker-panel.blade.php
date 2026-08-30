@php
    $id = 'antiflicker-panel-' . uniqid();
    Nozbi\Uikit\ScriptExecutor::execute('panels.show', $id);
@endphp

<div class="uikit-panels-antiflicker-panel" id="{{ $id }}">  
    <x-uikit::panels.fill-panel>
    {{ $slot }}
    </x-uikit::panels.fill-panel>
</div>

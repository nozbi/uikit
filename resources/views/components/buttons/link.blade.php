@props([
    'route',
    'livewire' => false,
    'parameters' => [],
])

@php
    $livewireAttribute = '';
    if ($livewire)
    {
       $livewireAttribute = 'wire:navigate.hover'; 
    }
@endphp

<x-uikit::buttons.fill-panel>
    <a class="uikit-buttons-link" href="{{ route($route, $parameters) }}" {{ $livewireAttribute }}>
        <x-uikit::buttons.events-propagator>
            {{ $slot }}
        </x-uikit::buttons.events-propagator>
    </a>
</x-uikit::buttons.fill-panel>

@props([
    'topBarHeight',
])

<x-uikit::panels.top-edge-panel>
    <x-slot name="edge">
            <x-uikit::panels.left-edge-panel>
                <x-slot name="edge">
                    <x-uikit::panels.size-panel :width="$topBarHeight" :height="$topBarHeight">
                        {{ $toggleSlot }}  
                    </x-uikit::panels.size-panel>         
                </x-slot>
                <x-slot name="slot">
                    <x-uikit::panels.size-panel :height="$topBarHeight">
                        {{ $topBarSlot }}
                    </x-uikit::panels.size-panel>
                </x-slot>
            </x-uikit::panels.left-edge-panel>  
    </x-slot>
    <x-slot name="slot">
        <x-uikit::panels.left-edge-panel>
            <x-slot name="edge">
                {{ $sideBarSlot }}
            </x-slot>
            <x-slot name="slot">
                {{ $slot }}
            </x-slot>
        </x-uikit::panels.left-edge-panel>  
    </x-slot>
</x-uikit::panels.top-edge-panel>  


@props([
    'color',
    'backgroundColor',
    'title',
    'logo',
    'route',
    'livewire',
    'isAvatarSet',
    'avatarWidth',
])

<x-uikit::app-template.background :color="$backgroundColor"> 
    @if ($logo)
        <x-uikit::panels.right-edge-panel>
            <x-slot name="slot">
                <div class="uikit-app-template-logo" style="color:white;">
                    <x-uikit::buttons.link :route="$route" :livewire="$livewire">
                        <x-uikit::app-template.interactive-panel :color="$color" :background-color="'transparent'" :transparent="true">
                            <img class="uikit-app-template-logo-image" src="{{ asset($logo) }}" title="{{ $title }}">
                        </x-uikit::app-template.interactive-panel>
                    </x-uikit::buttons.link>
                </div>
            </x-slot>
            <x-slot name="edge">
                @if (!$isAvatarSet)
                    <x-uikit::panels.size-panel :width="$avatarWidth"/>
                @endif
            </x-slot>
        </x-uikit::panels.right-edge-panel>
    @endif
</x-uikit::app-template.background>
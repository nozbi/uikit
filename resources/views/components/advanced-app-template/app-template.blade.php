@props([
    'menuItems',

    'livewire' => false,

    'avatar' => null,
    'logo' => null,
    'logoRoute' => null,         

    'openSideBarText' => 'open side bar',
    'closeSideBarText' => 'close side bar',
    'searchBarPlaceholder' => 'Search...',          
    'logoText' => 'logo',
    'avatarText' => 'avatar',

    'primaryColor' => 'black', 
    'secondaryColor' => 'white',
    'secondaryActiveColor' => 'orange',

    'footerText' => '© 2026 UIkit. All rights reserved.',
    'breadcrumbs' => [[fn (array $params): string => 'Uikit']],
])

@php
    $header = end($breadcrumbs)[0](request()->route()->parameters());
@endphp

<x-uikit::app-template
    :menu-items="$menuItems"
    :livewire="$livewire"
    :avatar="$avatar"
    :logo="$logo"
    :logo-route="$logoRoute"

    :open-side-bar-text="$openSideBarText"
    :close-side-bar-text="$closeSideBarText"
    :search-bar-placeholder="$searchBarPlaceholder"
    :logo-text="$logoText"
    :avatar-text="$avatarText"

    :color="$secondaryColor"
    :active-color="$secondaryActiveColor"
    :background-color="$primaryColor"
>





<div class="uikit-advanced-app-template" style="--uikit-advanced-app-template-scrollbar-color:{{ $primaryColor }}; background-color:{{ $secondaryColor }};">
    <div class="uikit-advanced-app-template-breadcrumbs">
        @if (count($breadcrumbs) > 1)
            <x-uikit::panels.horizontal-panel>
                @foreach ($breadcrumbs as $index => $breadcrumb)
                    <x-uikit::buttons.link :route="$breadcrumb[1]" :parameters="request()->route()->parameters()" :livewire="$livewire">
                        <x-uikit::app-template.interactive-panel :color="$primaryColor" :background-color="'transparent'">
                            @if ($index !== 0)
                                &nbsp;>
                            @endif    
                            {{ $breadcrumb[0](request()->route()->parameters()) }}
                        </x-uikit::app-template.interactive-panel>
                    </x-uikit::buttons.link>
                @endforeach
            </x-uikit::panels.horizontal-panel>   
        @else
            &nbsp;
        @endif
    </div> 
    <div class="uikit-advanced-app-template-header">
        {{ $header }}
    </div>
    <div class="uikit-advanced-app-template-slot">
        {{ $slot }}
    </div>
    <div class="uikit-advanced-app-template-footer" style="background:{{ $primaryColor }}; color:{{ $secondaryColor }};">
        {{ $footerText }}
    </div>
  </div>



</x-uikit::app-template>
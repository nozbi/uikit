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

    'color' => 'white',
    'activeColor' => 'orange',
    'backgroundColor' => 'black'
])

@php
    use Nozbi\Uikit\AppTemplate;

    $topBarColor = $backgroundColor;
    $menuColor = AppTemplate::getColorWithOpacity($topBarColor, 90, 'white');
    $scrollBarColor = AppTemplate::getColorWithOpacity($menuColor, 50, 'white');
    $searchBarColor = AppTemplate::getColorWithOpacity($menuColor, 90, 'white');
    $placeholderColor = AppTemplate::getColorWithOpacity($searchBarColor, 80, 'white');
    $highlightColor = $scrollBarColor;
    $selectionColor = $scrollBarColor;
    $topBarHeight = 50;
    $menuBarPadding = 5;
    $searchBarPadding = 10;
    $searchBarFontSize = 20;
    $sideBarWidth = 300;
    $avatarPadding = 5;
    $dropdownWidth = 200;
    $menuBarHeight = $searchBarFontSize + (2 * ($menuBarPadding + $searchBarPadding));
    $localStorageKey = AppTemplate::getBaseLocalStorageKey();
    $searchBarLocalStorageKey = $localStorageKey . '-search-bar';
    $fontSize = $searchBarFontSize;
    $menuItemLeftPadding = $menuBarPadding + $searchBarPadding;
    $menuItemRightPadding = $menuBarPadding;
    $sideBarMenuItems = AppTemplate::getSideBarMenuItems($menuItems, $color, $activeColor, $fontSize, $menuItemLeftPadding, $menuItemRightPadding);
    $dropdownMenuItems = AppTemplate::getDropdownMenuItems($menuItems, $color, $activeColor, $fontSize, $menuItemLeftPadding, $menuItemRightPadding);
@endphp

<div class="uikit-app-template" style="--uikit-app-template-mark-color:{{ $highlightColor }}; --uikit-app-template-selection-color:{{ $selectionColor }}; --uikit-app-template-scroll-panel-color:{{ $menuColor }}; --uikit-app-template-scrollbar-color:{{ $scrollBarColor }};">
    <x-uikit::app-template-builder.app-template :side-bar-menu-items="$sideBarMenuItems" :side-bar-menu-item-component="'uikit::app-template.menu-item-component'" :side-bar-menu-bar-height="$menuBarHeight" :livewire="$livewire" :top-bar-height="$topBarHeight" :side-bar-width="$sideBarWidth" :local-storage-key="$localStorageKey" :dropdown-menu-items="$dropdownMenuItems" :dropdown-menu-item-component="'uikit::app-template.menu-item-component'" :dropdown-width="$dropdownWidth">
        <x-slot name="sideBarToggleSlot">
            <x-uikit::app-template.hamburger :color="$color" :background-color="$topBarColor" :title="$openSideBarText" :is-for-close="false"/>
        </x-slot>
        <x-slot name="sideBarToggledToggleSlot">
            <x-uikit::app-template.hamburger :color="$color" :background-color="$topBarColor" :title="$closeSideBarText" :is-for-close="true"/>
        </x-slot>
        <x-slot name="topBarSlot"> 
            <x-uikit::app-template.logo :color="$color" :background-color="$topBarColor" :title="$logoText" :logo="$logo" :route="$logoRoute" :livewire="$livewire" :is-avatar-set="$avatar !== null" :avatarWidth="$topBarHeight"/>
        </x-slot>
        @if ($avatar)
            <x-slot name="dropdownToggleSlot">
                <x-uikit::app-template.avatar :color="$color" :background-color="$topBarColor" :title="$avatarText" :avatar="$avatar"/>
            </x-slot>
            <x-slot name="dropdownToggledToggleSlot">
                <x-uikit::app-template.avatar :color="$color" :background-color="$topBarColor" :title="$avatarText" :avatar="$avatar"/>
            </x-slot>
        @endif
        <x-slot name="sideBarMenuSearchBarSlot">
            <x-uikit::app-template.search-bar :color="$color" :placeholder-color="$placeholderColor" :background-color="$menuColor" :input-background-color="$searchBarColor" :placeholder="$searchBarPlaceholder" :padding="$menuBarPadding" :input-padding="$searchBarPadding" :font-size="$searchBarFontSize" :local-storage-key="$searchBarLocalStorageKey"/>
        </x-slot>
        <x-slot name="sideBarMenuCollapseButtonSlot">
            <x-uikit::app-template.arrow-button-interactive-panel :color="$color" :background-color="$menuColor" :padding-top="$menuBarPadding" :padding-right="$menuBarPadding" :direction="'up'"/>
        </x-slot>
        <x-slot name="sideBarMenuExpandButtonSlot">
            <x-uikit::app-template.arrow-button-interactive-panel :color="$color" :background-color="$menuColor" :padding-bottom="$menuBarPadding" :padding-right="$menuBarPadding" :direction="'down'"/>
        </x-slot>
        <x-slot name="slot">
            {{ $slot }}
        </x-slot>
    </x-uikit::app-template.app-template>
</div>
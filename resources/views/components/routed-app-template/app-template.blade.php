@props([
    'menuItems',
    'breadcrumbs',
    'configResolver',
])

@php
    $config = $configResolver();
@endphp

<x-dynamic-component :component="$config->htmlDocumentTemplateComponent ?? 'uikit::routed-app-template.html-document'" :title="end($breadcrumbs)[0](request()->route()->parameters())">
    <x-uikit::advanced-app-template.app-template
        :menu-items="\Nozbi\Uikit\RoutedAppTemplate\Utils::getAuthorizedMenuItems($menuItems)"
        :livewire="$config->livewire"
        :avatar="$config->avatar"
        :logo="$config->logo"
        :logo-route="$config->rootRoute"

        :open-side-bar-text="$config->openSideBarText"
        :close-side-bar-text="$config->closeSideBarText"
        :search-bar-placeholder="$config->searchBarPlaceholder"
        :logo-text="$config->logoText"
        :avatar-text="$config->avatarText"

        :primary-color="$config->primaryColor"
        :secondary-color="$config->secondaryColor"
        :active-color="$config->activeColor"

        :footer-text="$config->footerText"
        
        :breadcrumbs="$breadcrumbs"
    >
        <x-dynamic-component :component="$config->viewWrapperComponent ?? 'uikit::routed-app-template.view-wrapper'">
            {{ $slot }}
        </x-dynamic-component>
    </x-uikit::app-template>
</x-dynamic-component>
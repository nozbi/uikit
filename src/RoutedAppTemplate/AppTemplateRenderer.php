<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Nozbi\Uikit\BladeComponentRenderer;

final class AppTemplateRenderer
{
    public static function render(
        array $menuItems,
        string $slot,
        ?bool $livewire = null,
        ?string $avatar = null,
        ?string $logo = null,
        ?string $rootRoute = null,
        ?string $openSideBarText = null,
        ?string $closeSideBarText = null,
        ?string $searchBarPlaceholder = null,
        ?string $logoText = null,
        ?string $avatarText = null,
        ?string $primaryColor = null,
        ?string $secondaryColor = null,
        ?string $secondaryActiveColor = null,
        ?string $footerText = null,
        ?array $breadcrumbs = null
    ): string
    {
        $appTemplateAttributes = array_filter([
            'menuItems' => $menuItems,
            'livewire' => $livewire,
            'avatar' => $avatar,
            'logo' => $logo,
            'logoRoute' => $rootRoute,
            'openSideBarText' => $openSideBarText,
            'closeSideBarText' => $closeSideBarText,
            'searchBarPlaceholder' => $searchBarPlaceholder,
            'logoText' => $logoText,
            'avatarText' => $avatarText,
            'primaryColor' => $primaryColor,
            'secondaryColor' => $secondaryColor,
            'secondaryActiveColor' => $secondaryActiveColor,
            'footerText' => $footerText,
            'breadcrumbs' => $breadcrumbs,
        ], static fn ($value) => $value !== null);
        return BladeComponentRenderer::render('uikit::advanced-app-template.app-template', $appTemplateAttributes, ['slot' => $slot]);
    }
}
<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Nozbi\Uikit\BladeComponentRenderer;

final class AppTemplateRenderer //todo make uth calklngi closure here
{
    private static function getAuthorizedMenuItems(array $menuItems): array
    {
        foreach ($menuItems as $index => $menuItem) 
        {   
            $hasAccess = null;
            $submenuMenuItemsOrLinkRouteName = $menuItem[1];
            $isSubmenu = is_array($submenuMenuItemsOrLinkRouteName);
            if (is_array($submenuMenuItemsOrLinkRouteName))
            {
                $hasAccess = $menuItem[2]([]) === true;
            }
            else 
            {
                $hasAccess = $menuItem[3]([]) === true;
            }
            if (!$hasAccess)
            {
                unset($menuItems[$index]);
            }
            else if ($isSubmenu)
            {
                $menuItem[1] = self::getAuthorizedMenuItems($submenuMenuItemsOrLinkRouteName);
                $menuItems[$index] = $menuItem;
            }
        }
        return $menuItems;
    }

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
            'menuItems' => self::getAuthorizedMenuItems($menuItems),
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
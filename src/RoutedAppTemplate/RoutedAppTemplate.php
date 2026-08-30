<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Closure;

final readonly class RoutedAppTemplate
{
    private readonly AppTemplateRouteCreator $appTemplateRouteCreator;

    private static function getLinks(array $menuItems, bool $auth): array
    {
        $links = [];
        foreach ($menuItems as $menuItem) 
        {   
            $submenuMenuItemsOrLinkRouteName = $menuItem[1];
            if (is_array($submenuMenuItemsOrLinkRouteName))
            {
                $menuItem[2] = $auth && $menuItem[2];
                $subMenuAuth = $menuItem[2];
                $links = array_merge($links, self::getLinks($submenuMenuItemsOrLinkRouteName, $subMenuAuth));
            }
            else 
            {
                $menuItem[3] = $auth && $menuItem[3];
                $links[] = $menuItem;
            }
        }
        return $links;
    }

    private static function getAuthorizedMenuItems(array $menuItems): array
    {
        foreach ($menuItems as $index => $menuItem) 
        {   
            $hasAccess = null;
            $submenuMenuItemsOrLinkRouteName = $menuItem[1];
            $isSubmenu = is_array($submenuMenuItemsOrLinkRouteName);
            if (is_array($submenuMenuItemsOrLinkRouteName))
            {
                $hasAccess = $menuItem[2] ?? true;
            }
            else 
            {
                $hasAccess = $menuItem[3] ?? true;
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

    public function __construct( 
        array $menuItems,
        bool $livewire = null,
        ?string $avatar = null,
        ?string $logo = null,
        ?string $rootRoute = null,
        ?string $htmlDocumentTemplateComponent = null,
        ?string $viewWrapperComponent = null,
        ?string $openSideBarText = null,
        ?string $closeSideBarText = null,
        ?string $searchBarPlaceholder = null,
        ?string $logoText = null,
        ?string $avatarText = null,
        ?string $primaryColor = null,
        ?string $secondaryColor = null,
        ?string $secondaryActiveColor = null,
        ?string $footerText = null,
    )
    {
        $authorizedMenuItems = self::getAuthorizedMenuItems($menuItems);
        $this->appTemplateRouteCreator = new AppTemplateRouteCreator(
            $authorizedMenuItems, 
            $livewire,
            $avatar,
            $logo,
            $rootRoute,
            $openSideBarText,
            $closeSideBarText,
            $searchBarPlaceholder,
            $logoText,
            $avatarText,
            $primaryColor,
            $secondaryColor,
            $secondaryActiveColor,
            $footerText,
            $htmlDocumentTemplateComponent,
            $viewWrapperComponent,
        );
        $links = self::getLinks($menuItems, true);
        foreach ($links as $link)
        {
            $label = $link[0];
            $name = $link[1];
            $auth = $link[3];
            $this->appTemplateRouteCreator->createNavRoute($name, $auth, $label);
        }
        Route::get('/', function () use ($rootRoute)
        {
            return redirect()->route($rootRoute);
        });
    }

    public function createSubRoute(string $url, string $name, Closure $authResolver, array $breadcrumbs)
    {
        $this->appTemplateRouteCreator->createSubRoute($url, $name, $authResolver, $breadcrumbs);
    }
}
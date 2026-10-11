<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\RedirectResponse;

final readonly class RoutedAppTemplate
{
    public const LINK_LABEL_INDEX = 0;
    public const LINK_ROUTE_INDEX = 1;
    public const LINK_DROPDOWN_INDEX_INDEX = 2;
    public const LINK_AUTH_INDEX = 3;
    public const LINK_CREATE_ROUTE_INDEX = 4;
    public const MENU_LABEL_INDEX = 0;
    public const MENU_ITEMS_INDEX = 1;
    public const MENU_AUTH_INDEX = 2;

    private readonly RouteCreator $routeCreator;

    private static function getLinks(array $menuItems, Closure $authResolver): array
    {
        $links = [];
        foreach ($menuItems as $menuItem) 
        {   
            $submenuMenuItemsOrLinkRouteName = $menuItem[self::MENU_ITEMS_INDEX];
            if (is_array($submenuMenuItemsOrLinkRouteName))
            {
                $menuItem[self::MENU_AUTH_INDEX] = fn (): bool => $authResolver() && ($menuItem[self::MENU_AUTH_INDEX])();
                $subMenuAuth = $menuItem[self::MENU_AUTH_INDEX];
                $links = array_merge($links, self::getLinks($submenuMenuItemsOrLinkRouteName, $subMenuAuth));
            }
            else 
            {
                $menuItem[self::LINK_AUTH_INDEX] = fn (): bool => $authResolver() && ($menuItem[self::LINK_AUTH_INDEX])();
                if ($menuItem[self::LINK_CREATE_ROUTE_INDEX])
                {
                    $links[] = $menuItem;
                }
            }
        }
        return $links;
    }

    public function __construct(array $menuItems, Closure $configResolver)
    {
        $this->routeCreator = new RouteCreator($menuItems, $configResolver);
        $links = self::getLinks($menuItems, fn (): bool => true);
        foreach ($links as $link)
        {
            $label = $link[self::LINK_LABEL_INDEX];
            $name = $link[self::LINK_ROUTE_INDEX];
            $auth = $link[self::LINK_AUTH_INDEX];
            $this->routeCreator->createNavRoute($name, $auth, $label);
        }
        Route::get('/', fn (): RedirectResponse => redirect()->route($configResolver()->rootRoute));
    }

    public function createSubRoute(string $url, string $name, Closure $authResolver, array $breadcrumbs)
    {
        $this->routeCreator->createSubRoute($url, $name, $authResolver, $breadcrumbs);
    }

    public function render(string $slot, array $breadcrumbs): string
    {
        return $this->routeCreator->render($slot, $breadcrumbs);
    }
}
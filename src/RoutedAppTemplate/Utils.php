<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Nozbi\Uikit\BladeComponentRenderer;

final class Utils
{
    public static function getAuthorizedMenuItems(array $menuItems): array
    {
        foreach ($menuItems as $index => $menuItem) 
        {   
            $hasAccess = null;
            $submenuMenuItemsOrLinkRouteName = $menuItem[RoutedAppTemplate::MENU_ITEMS_INDEX];
            $isSubmenu = is_array($submenuMenuItemsOrLinkRouteName);
            if (is_array($submenuMenuItemsOrLinkRouteName))
            {
                $hasAccess = $menuItem[RoutedAppTemplate::MENU_AUTH_INDEX]() === true;
            }
            else 
            {
                $hasAccess = $menuItem[RoutedAppTemplate::LINK_AUTH_INDEX]() === true;
            }
            if (!$hasAccess)
            {
                unset($menuItems[$index]);
            }
            else if ($isSubmenu)
            {
                $menuItem[RoutedAppTemplate::MENU_ITEMS_INDEX] = self::getAuthorizedMenuItems($submenuMenuItemsOrLinkRouteName);
                $menuItems[$index] = $menuItem;
            }
        }
        return $menuItems;
    }
}
<?php

namespace Nozbi\Uikit;

use Illuminate\Support\Facades\Auth;

class AppTemplate
{
    private const INTERNAL_MENU_ITEM_ATTRIBUTES_INDEX = 0;
    private const INTERNAL_MENU_ITEM_ROUTE_OR_SUBMENU_INDEX = 1;
    private const INTERNAL_SUBMENU_LOCAL_STORAGE_KEY_INDEX = 2;

    private const MENU_ITEM_LABEL_INDEX = 0;
    private const MENU_ITEM_ROUTE_OR_SUBMENU_INDEX = 1;
    private const MENU_ITEM_DROPDOWN_INDEX_INDEX = 2;

    public static function getBaseLocalStorageKey(): string
    {
        $baseLocalStorageKey = 'uikit-app-template';
        $userId = Auth::id();
        if ($userId)
        {
            $baseLocalStorageKey .= '-' . $userId;
        }
        return $baseLocalStorageKey;
    }

    public static function transformMenuItems(array $items, string $color, string $activeColor, int $baseFontSize, int $leftPadding, int $rightPadding): array
    {
        $newItems = [];
        foreach ($items as $item) 
        {
            $label = $item[self::MENU_ITEM_LABEL_INDEX];
            $newItem = $item;
            $newItem[self::INTERNAL_MENU_ITEM_ATTRIBUTES_INDEX] = 
            [
                'label' => $label,
                'color' => $color,
                'activeColor' => $activeColor,
                'baseFontSize' => $baseFontSize,
                'leftPadding' => $leftPadding,
                'rightPadding' => $rightPadding
            ];
            $routeOrSubmenu = $item[self::MENU_ITEM_ROUTE_OR_SUBMENU_INDEX];
            if (is_array($routeOrSubmenu)) 
            {
                $newItem[self::INTERNAL_MENU_ITEM_ROUTE_OR_SUBMENU_INDEX] = self::transformMenuItems($routeOrSubmenu, $color, $activeColor, $baseFontSize, $leftPadding, $rightPadding);
                $newItem[self::INTERNAL_SUBMENU_LOCAL_STORAGE_KEY_INDEX] = self::getBaseLocalStorageKey() . $label;
            }
            $newItems[] = $newItem;
        }
        return $newItems;
    }

    public static function getSideBarMenuItems(array $items, string $color, string $activeColor, int $baseFontSize, int $leftPadding, int $rightPadding): array
    {
        return self::transformMenuItems($items, $color, $activeColor, $baseFontSize, $leftPadding, $rightPadding);
    }

    public static function getDropdownMenuItems(array $items, string $color, string $activeColor, int $baseFontSize, int $leftPadding, int $rightPadding): array
    {
        return self::transformMenuItems(self::getDropdownMenuItemsInternal($items), $color, $activeColor, $baseFontSize, $leftPadding, $rightPadding);
    }

    public static function getDropdownMenuItemsInternal(array $items): array
    {
        $newItems = [];
        foreach ($items as $item) 
        {
            if (is_int($item[self::MENU_ITEM_DROPDOWN_INDEX_INDEX] ?? null)) 
            {
                $newItems[] = $item;
            }
            if (is_array($item[self::MENU_ITEM_ROUTE_OR_SUBMENU_INDEX])) 
            {
                $newItems = array_merge($newItems, self::getDropdownMenuItemsInternal($item[self::MENU_ITEM_ROUTE_OR_SUBMENU_INDEX]));
            }
        }
        usort($newItems, fn($a, $b) => ($a[self::MENU_ITEM_DROPDOWN_INDEX_INDEX]) <=> ($b[self::MENU_ITEM_DROPDOWN_INDEX_INDEX]));
        return $newItems;
    }

    public static function getColorWithOpacity(string $color, int $opacity, string $secondColor = 'transparent')
    {
        return "color-mix(in srgb, {$color} {$opacity}%, {$secondColor})";
    }
}

<?php

namespace Nozbi\Uikit;

use Illuminate\Support\Facades\Route;

class Menu
{
    private const NODE_ATTRIBUTES_INDEX = 0;
    private const NODE_SUBTREE_INDEX = 1;
    private const NODE_IS_TOGGLED_INDEX = 2;
    private const NODE_LOCAL_STORAGE_KEY_INDEX = 3;
    private const MENU_ITEM_ATTRIBUTES_INDEX = 0;
    private const MENU_ITEM_ROUTE_OR_SUBMENU_INDEX = 1;
    private const SUBMENU_LOCAL_STORAGE_KEY = 2;

    private static function isLinkActive(string $route) :bool
    {
        return request()->routeIs($route, $route . '_*');
    }

    private static function isSubmenuActive(array $submenu) :bool
    {
        foreach ($submenu as $menuItem)
        {
            $routeOrSubmenu = $menuItem[self::MENU_ITEM_ROUTE_OR_SUBMENU_INDEX];
            if ((is_string($routeOrSubmenu) && self::isLinkActive($routeOrSubmenu)) || (!is_string($routeOrSubmenu) && self::isSubmenuActive($routeOrSubmenu)))
            {
                return true;
            }
        }
        return false;
    }

    public static function transformToNodes(array $menuItems, string $menuItemComponent, bool $livewire) :array
    {
        $nodes = [];
        foreach ($menuItems as $menuItem) 
        {
            $node = [];
            $menuItemAttributes = $menuItem[self::MENU_ITEM_ATTRIBUTES_INDEX];
            $nodeAttributes = ['menuItemComponent' => $menuItemComponent];
            $routeOrSubmenu = $menuItem[self::MENU_ITEM_ROUTE_OR_SUBMENU_INDEX];
            $isActive = null;
            if (is_string($routeOrSubmenu))
            {
                $isActive = self::isLinkActive($routeOrSubmenu);
                $nodeAttributes['route'] = $routeOrSubmenu;
                $nodeAttributes['livewire'] = $livewire;
            }
            else 
            {
                $isActive = self::isSubmenuActive($routeOrSubmenu);
                $node[self::NODE_SUBTREE_INDEX] = self::transformToNodes($routeOrSubmenu, $menuItemComponent, $livewire);
                $node[self::NODE_IS_TOGGLED_INDEX] = $isActive;
                $node[self::NODE_LOCAL_STORAGE_KEY_INDEX] = $menuItem[self::SUBMENU_LOCAL_STORAGE_KEY] ?? null;
            }
            $menuItemAttributes['isActive'] = $isActive;
            $nodeAttributes['menuItemAttributes'] = $menuItemAttributes;
            $node[self::NODE_ATTRIBUTES_INDEX] = $nodeAttributes;
            $nodes[] = $node;
        }
        return $nodes;
    }
}

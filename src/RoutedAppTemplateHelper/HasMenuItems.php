<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

trait HasMenuItems
{
    private readonly MenuItems $menuItemsObject;
    protected final readonly array $menuItems;

    private function getMenuItemsObject(): MenuItems
    {
        return $this->menuItemsObject ??= new MenuItems(...$this->menuItems);
    }

    protected final function getMenuItemsAsArray(): array
    {
        return $this->getMenuItemsObject()->toArray();
    }

    public final function getNavRoutes(): array
    {
        return $this->getMenuItemsObject()->getNavRoutes();
    }
}
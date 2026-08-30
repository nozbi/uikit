<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

final class MenuItems extends Arrayable
{
    private readonly array $navRoutes;

    public function __construct(MenuItem ...$menuItems) 
    {
        $navRoutes = [];
        $menuItemsArray = [];
        foreach ($menuItems as $menuItem)
        {
            $menuItemsArray[] = $menuItem->toArray();
            if ($menuItem instanceof SubMenu)
            {
                $subMenu = $menuItem;
                $navRoutes = array_merge($navRoutes, $subMenu->getNavRoutes());
            }
            else
            {
                $navRoutes[] = $menuItem;
            }
        }
        $this->navRoutes = $navRoutes;
        parent::__construct($menuItemsArray);
    }

    public function getNavRoutes(): array
    {
        return $this->navRoutes;
    }
}
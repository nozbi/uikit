<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

use Closure;

final class SubMenu extends MenuItem
{
    use HasMenuItems;

    public function __construct(string $label, Closure $authResolver, MenuItem ...$menuItems)
    {
        $this->menuItems = $menuItems;
        $array = [];
        $array[] = $label;
        $array[] = $this->getMenuItemsAsArray();
        $array[] = $authResolver;
        parent::__construct($array, $authResolver);
        foreach ($menuItems as $menuItem)
        {
            $menuItem->setParentAuthResolver($authResolver);
        }
    }
}
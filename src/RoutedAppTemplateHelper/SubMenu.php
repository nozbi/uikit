<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

final class SubMenu extends MenuItem
{
    use HasMenuItems;

    public function __construct(string $label, bool $auth, MenuItem ...$menuItems)
    {
        $this->menuItems = $menuItems;
        $array = [];
        $array[] = $label;
        $array[] = $this->getMenuItemsAsArray();
        $array[] = $auth;
        parent::__construct($array, $auth);
        foreach ($menuItems as $menuItem)
        {
            $menuItem->setParentAuth($auth);
        }
    }
}
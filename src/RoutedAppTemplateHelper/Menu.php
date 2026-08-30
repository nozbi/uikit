<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

final class Menu extends Arrayable
{   
    use HasMenuItems;

    public function __construct(MenuItem ...$menuItems)
    {
        $this->menuItems = $menuItems;
        parent::__construct($this->getMenuItemsAsArray());
    }
}
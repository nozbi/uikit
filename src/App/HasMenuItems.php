<?php

namespace Nozbi\Uikit\App;

trait HasMenuItems
{
    private array $menuItems = [];

    private function addMenuItem(MenuItem $menuItem): MenuItem
    {
        $this->menuItems[] = $menuItem;
        return $menuItem;
    }

    private function addMenuRoute(string $name, string $label, ?int $dropdownMenuIndex): MenuRoute
    {
        return $this->addMenuItem(new MenuRoute($name, $label, $this, $dropdownMenuIndex));
    }

    protected final function getInternalMenuItems(): array
    {
        $items = [];
        foreach ($this->menuItems as $menuItem) 
        {
            $items[] = $menuItem->toInternal();
        }
        return $items;
    }

    public final function startMenu(string $name, string $label): Menu
    {
        return $this->addMenuItem(new Menu($name, $label, $this));
    }

    public final function menuRoute(string $name, string $label, ?int $userMenuIndex = null): self
    {
        $this->addMenuRoute($name, $label, $userMenuIndex);
        return $this;
    }

    public final function startMenuRoute(string $name, string $label, ?int $userMenuIndex = null): MenuRoute
    {
        return $this->addMenuRoute($name, $label, $userMenuIndex);
    }
}
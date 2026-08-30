<?php

namespace Nozbi\Uikit\App;

use Nozbi\Uikit\RoutedAppTemplateHelper\SubMenu as InternalSubMenu;

final class Menu extends MenuItem
{
    use HasMenuItems;

    public function __construct(string $name, string $label, Config|self $parent) 
    {
        parent::__construct($name, $label, $parent);
    }

    #[\Override]
    public function toInternal(): InternalSubMenu
    {
        return new InternalSubMenu($this->getLabel(), $this->getAuth(), ...$this->getInternalMenuItems());
    }

    public function endMenu(): Config|self
    {
        return $this->getParent();
    }
}
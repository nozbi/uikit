<?php

namespace Nozbi\Uikit\App;

use Nozbi\Uikit\RoutedAppTemplateHelper\Menu as InternalMenu;

final class Config
{
    use HasMenuItems;

    public function toInternal(): InternalMenu
    {
        return new InternalMenu(...$this->getInternalMenuItems());
    }
}
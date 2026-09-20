<?php

namespace Nozbi\Uikit\App;

use Nozbi\Uikit\RoutedAppTemplateHelper\SubMenu as InternalSubMenu;
use Nozbi\Uikit\RoutedAppTemplateHelper\NavRoute as InternalNavRoute;
use Closure;

abstract class MenuItem
{
    protected function __construct(private readonly string $name, private readonly string $label, private readonly Config|Menu $parent) 
    {
       
    }

    protected function getName(): string
    {
        return $this->name;
    }

    protected function getLabel(): string
    {
        return $this->label;
    }

    protected function getAuthResolver(): Closure
    {
        return fn (): bool => App::canMenuItem($this->name);
    }

    protected function getParent(): Config|Menu
    {
        return $this->parent;
    }

    public abstract function toInternal(): InternalSubMenu|InternalNavRoute;

}
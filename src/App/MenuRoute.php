<?php

namespace Nozbi\Uikit\App;

use Nozbi\Uikit\RoutedAppTemplateHelper\NavRoute as InternalNavRoute;

final class MenuRoute extends MenuItem
{
    use HasSubRoutes;

    public function __construct(string $name, string $label, Config|Menu $parent, private readonly ?int $dropdownMenuIndex, private readonly bool $createRoute) 
    {
        $this->name = $name;
        parent::__construct($name, $label, $parent);
    }

    #[\Override]
    public function toInternal(): InternalNavRoute
    {
        return new InternalNavRoute($this->getLabel(), $this->getAuthResolver(), $this->getName(), $this->dropdownMenuIndex, $this->createRoute, ...$this->getInternalSubRoutes());
    }

    public function endMenuRoute(): Config|Menu
    {
        return $this->getParent();
    }
}
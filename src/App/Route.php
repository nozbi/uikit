<?php

namespace Nozbi\Uikit\App;

final class Route extends SubRoute
{
    public function __construct(string $name, ?string $label, MenuRoute|SubRoute $parentNavRouteOrSubRoute, bool $createRoute) 
    {
        parent::__construct($name, $label, false, $parentNavRouteOrSubRoute, $createRoute);
    }

    public function endRoute(): MenuRoute|Route|ParamRoute
    {
        return $this->getParent();
    }
}
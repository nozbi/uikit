<?php

namespace Nozbi\Uikit\App;

final class Route extends SubRoute
{
    public function __construct(string $name, ?string $label, MenuRoute|SubRoute $parentNavRouteOrSubRoute) 
    {
        parent::__construct($name, $label, false, $parentNavRouteOrSubRoute);
    }

    public function endRoute(): MenuRoute|Route|ParamRoute
    {
        return $this->getParent();
    }
}
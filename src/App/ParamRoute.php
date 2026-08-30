<?php

namespace Nozbi\Uikit\App;

final class ParamRoute extends SubRoute
{
    public function __construct(string $name, ?string $label, MenuRoute|SubRoute $parent) 
    {
        parent::__construct($name, $label, true, $parent);
    }

    public function endParamRoute(): MenuRouteEnder|RouteEnder|ParamRouteEnder
    {
        $parent = $this->getParent();
        if ($parent instanceof MenuRoute)
        {
            return new MenuRouteEnder($parent);
        }
        if ($parent instanceof Route)
        {
            return new RouteEnder($parent);
        }
        return new ParamRouteEnder($parent);
    }
}
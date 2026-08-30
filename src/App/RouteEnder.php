<?php

namespace Nozbi\Uikit\App;

final readonly class RouteEnder
{
    public function __construct(private Route $route) 
    {
        
    }

    public function endRoute(): MenuRoute|Route|ParamRoute
    {
        return $this->route->endRoute();
    }
}
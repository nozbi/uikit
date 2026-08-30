<?php

namespace Nozbi\Uikit\App;

final readonly class ParamRouteEnder
{
    public function __construct(private ParamRoute $paramRoute) 
    {
        
    }

    public function endParamRoute(): MenuRouteEnder|RouteEnder|ParamRouteEnder
    {
        return $this->paramRoute->endParamRoute();
    }
}
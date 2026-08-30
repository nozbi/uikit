<?php

namespace Nozbi\Uikit\App;

final readonly class MenuRouteEnder
{
    public function __construct(private MenuRoute $menuRoute) 
    {
        
    }

    public function endMenuRoute(): Config|Menu
    {
        return $this->menuRoute->endMenuRoute();
    }
}
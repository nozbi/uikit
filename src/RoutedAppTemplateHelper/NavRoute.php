<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

use Closure;

final class NavRoute extends MenuItem
{
    use HasRouteData;

    public function __construct(private readonly string $label, Closure $authResolver, string $name, ?int $dropdownMenuIndex, SubRoute ...$subRoutes) 
    {
        $this->name = $name;
        $this->subRoutes = $subRoutes;
        $array = [];
        $array[] = $label;
        $array[] = $name;
        $array[] = $dropdownMenuIndex;
        $array[] = $authResolver;
        parent::__construct($array, $authResolver);
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
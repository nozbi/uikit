<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

final class NavRoute extends MenuItem
{
    use HasRouteData;

    public function __construct(private readonly string $label, bool $auth, string $name, ?int $dropdownMenuIndex, SubRoute ...$subRoutes) 
    {
        $this->name = $name;
        $this->subRoutes = $subRoutes;
        $array = [];
        $array[] = $label;
        $array[] = $name;
        $array[] = $dropdownMenuIndex;
        $array[] = $auth;
        parent::__construct($array, $auth);
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
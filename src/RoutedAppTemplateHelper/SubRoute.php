<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

use Closure;

final readonly class SubRoute
{
    use HasRouteData;

    public function __construct(private Closure $labelResolver, private Closure $authResolver, string $name, private bool $parameterized, SubRoute ...$subRoutes) 
    {
        $this->name = $name;
        $this->subRoutes = $subRoutes;
    }

    public function getLabelResolver(): Closure
    {
        return $this->labelResolver;
    }

    public function getAuthResolver(): Closure
    {
        return $this->authResolver;
    }

    public function isParameterized(): bool
    {
        return $this->parameterized;
    }
}
<?php

namespace Nozbi\Uikit\App;

use Closure;
use Nozbi\Uikit\RoutedAppTemplateHelper\SubRoute as InternalSubRoute;

abstract class SubRoute
{
    use HasSubRoutes;

    private readonly Closure $labelResolver;

    public function __construct(string $name, ?string $label, private readonly bool $parameterized, private readonly MenuRoute|SubRoute $parent) 
    { 
        $this->name = $name;
        if ($label)
        {
            $this->labelResolver = fn (array $params): string => $label;
        }
        else
        {
            $this->labelResolver = fn (array $params): string => App::getSubRouteLabel($this->getFullName(), $params);
        }
    }

    public function toInternal(): InternalSubRoute
    {
        return new InternalSubRoute($this->labelResolver, fn (array $params): bool => App::canSubRoute($this->getFullName(), $params), $this->name, $this->parameterized, ...$this->getInternalSubRoutes());
    }

    protected function getParent(): MenuRoute|SubRoute
    {
        return $this->parent;
    }
}
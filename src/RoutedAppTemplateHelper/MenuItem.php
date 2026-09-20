<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

use Closure;

abstract class MenuItem extends Arrayable
{
    protected function __construct(array $array, private Closure $authResolver) 
    {
        parent::__construct($array);
    }

    protected final function setParentAuthResolver(Closure $parentAuthResolver): void
    {
        $authResolver = $this->authResolver;
        $this->authResolver = function () use ($parentAuthResolver, $authResolver): bool 
        {
            return $parentAuthResolver() && ($authResolver)();
        };
    }

    public final function getAuthResolver(): Closure
    {
        return $this->authResolver;
    }
}
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
        $this->authResolver = function () use (
            $parentAuthResolver
        ): bool {
            return $parentAuthResolver()
                && ($this->authResolver)();
        };
    }

    public final function getAuthResolver(): Closure
    {
        return $this->authResolver;
    }
}
<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

trait HasRouteData
{
    protected final readonly string $name;
    protected final readonly array $subRoutes;

    public final function getName(): string
    {
        return $this->name;
    }

    public final function getSubRoutes(): array
    {
        return $this->subRoutes;
    }
}
<?php

namespace Nozbi\Uikit\App;

trait HasSubRoutes
{
    private array $subRoutes = [];
    protected ?string $parentName = null;
    protected string $name;

    private function addSubRoute(SubRoute $subRoute): SubRoute
    {
        $subRoute->setParentName($this->getFullName());
        $this->subRoutes[] = $subRoute;
        return $subRoute;
    }

    private function addRoute(string $name, ?string $label, bool $createRoute): Route
    {
        return $this->addSubRoute(new Route($name, $label, $this, $createRoute));
    }

    private function addParamRoute(string $name, ?string $label, bool $createRoute): ParamRoute
    {
        return $this->addSubRoute(new ParamRoute($name, $label, $this, $createRoute));
    }

    protected final function getInternalSubRoutes(): array
    {
        $routes = [];
        foreach ($this->subRoutes as $subRoute) 
        {
            $routes[] = $subRoute->toInternal();
        }
        return $routes;
    }

    protected final function getFullName(): string
    {
        $fullName = ''; 
        if ($this->parentName)
        {
            $fullName .= $this->parentName . '_';
        }
        $fullName .= $this->name;
        return $fullName;
    }

    public final function setParentName(string $name): void
    {
        $this->parentName = $name;
    }

    public final function route(string $name, ?string $label = null, bool $createRoute = true): self
    {
        $this->addRoute($name, $label, $createRoute);
        return $this;
    }

    public final function paramRoute(string $name, ?string $label = null, bool $createRoute = true): self
    {
        $this->addParamRoute($name, $label, $createRoute);
        return $this;
    }

    public final function startRoute(string $name, ?string $label = null, bool $createRoute = true): Route
    {
        return $this->addRoute($name, $label, $createRoute);
    }

    public final function startParamRoute(string $name, ?string $label = null, bool $createRoute = true): ParamRoute
    {
        return $this->addParamRoute($name, $label, $createRoute);
    }
}
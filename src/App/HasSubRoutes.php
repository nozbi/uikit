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

    private function addRoute(string $name, ?string $label): Route
    {
        return $this->addSubRoute(new Route($name, $label, $this));
    }

    private function addParamRoute(string $name, ?string $label): ParamRoute
    {
        return $this->addSubRoute(new ParamRoute($name, $label, $this));
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

    public final function route(string $name, ?string $label = null): self
    {
        $this->addRoute($name, $label);
        return $this;
    }

    public final function paramRoute(string $name, ?string $label = null): self
    {
        $this->addParamRoute($name, $label);
        return $this;
    }

    public final function startRoute(string $name, ?string $label = null): Route
    {
        return $this->addRoute($name, $label);
    }

    public final function startParamRoute(string $name, ?string $label = null): ParamRoute
    {
        return $this->addParamRoute($name, $label);
    }
}
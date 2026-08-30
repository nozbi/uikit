<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

abstract class MenuItem extends Arrayable
{
    protected function __construct(array $array, private bool $auth) 
    {
        parent::__construct($array);
    }

    protected final function setParentAuth(bool $auth): void
    {
        $this->auth = $auth && $this->auth;
    }

    public final function getAuth(): bool
    {
        return $this->auth;
    }
}
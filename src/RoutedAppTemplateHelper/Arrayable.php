<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

abstract class Arrayable
{
    protected function __construct(private readonly array $array)
    {
    
    }

    public final function toArray(): array
    {
        return $this->array;
    }
}
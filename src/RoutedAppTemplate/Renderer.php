<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Nozbi\Uikit\BladeComponentRenderer;
use Closure;

final readonly class Renderer
{
    public function __construct(private array $menuItems, private Closure $configResolver) 
    {
        
    }

    public function render(string $slot, array $breadcrumbs): string
    {
        return BladeComponentRenderer::render('uikit::routed-app-template.app-template', ['menuItems' => $this->menuItems, 'breadcrumbs' => $breadcrumbs, 'configResolver' => $this->configResolver], ['slot' => $slot]);
    }
}
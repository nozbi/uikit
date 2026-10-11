<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Nozbi\Uikit\BladeComponentRenderer;
use Closure;

final readonly class RouteCreator
{
    private readonly Renderer $renderer;

    public function __construct(array $menuItems, Closure $configResolver)
    {
        $this->renderer = new Renderer($menuItems, $configResolver);
    }

    private function createRoute(string $url, string $name, Closure $authResolver, array $breadcrumbs)
    {
        Route::get('/' . $url, function () use ($name, $authResolver, $breadcrumbs)
        {
            if (!$authResolver(request()->route()->parameters()))
            {
                abort(403);
            }
            $view = BladeComponentRenderer::render('uikit::routed-app-template.placeholder', ['route' => $name]);
            $path = resource_path("views/{$name}.blade.php");
            if (is_file($path)) 
            {
                $view = view()->file($path, request()->route()->parameters());
            }
            $response = $this->renderer->render($view, $breadcrumbs);
            return response($response)->header('Cache-Control', 'private, no-cache');
        })->name($name);
    }

    public function createNavRoute(string $name, Closure $authResolver, string $label)
    {
        $this->createRoute(strtolower(preg_replace('/([A-Z])/', '-$1', $name)), $name, fn ($params): bool => $authResolver(), [[fn ($params): string => $label, $name]]);
    }

    public function createSubRoute(string $url, string $name, Closure $authResolver, array $breadcrumbs)
    {
        $this->createRoute($url, $name, $authResolver, $breadcrumbs);
    }

    public function render(string $slot, array $breadcrumbs): string
    {
        return $this->renderer->render($slot, $breadcrumbs);
    }
}
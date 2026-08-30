<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Nozbi\Uikit\BladeComponentRenderer;
use Closure;

final readonly class AppTemplateRouteCreator
{
    private readonly AppTemplateRouteRenderer $appTemplateRouteRenderer;

    private static function createRoute(AppTemplateRouteRenderer $appTemplateRouteRenderer, string $url, string $name, Closure $authResolver, array $breadcrumbs)
    {
        Route::get('/' . $url, function () use ($appTemplateRouteRenderer, $name, $authResolver, $breadcrumbs)
        {
            if (!$authResolver(request()->route()->parameters()))
            {
                abort(403);
            }
            $view = BladeComponentRenderer::render('uikit::routed-app-template.placeholder', ['route' => $name]);
            if (View::exists($name))
            {
                $view = view($name, request()->route()->parameters());
            }
            $response = $appTemplateRouteRenderer->render($view, $breadcrumbs);
            return response($response)->header('Cache-Control', 'private, no-cache');
        })->name($name);
    }

    public function __construct( 
        array $menuItems,
        ?bool $livewire = null,
        ?string $avatar = null,
        ?string $logo = null,
        ?string $rootRoute = null,
        ?string $openSideBarText = null,
        ?string $closeSideBarText = null,
        ?string $searchBarPlaceholder = null,
        ?string $logoText = null,
        ?string $avatarText = null,
        ?string $primaryColor = null,
        ?string $secondaryColor = null,
        ?string $secondaryActiveColor = null,
        ?string $footerText = null,
        ?string $htmlDocumentTemplateComponent = null,
        ?string $viewWrapperComponent = null,
    )
    {
        $this->appTemplateRouteRenderer = new AppTemplateRouteRenderer(
            $menuItems, 
            $livewire,
            $avatar,
            $logo,
            $rootRoute,
            $openSideBarText,
            $closeSideBarText,
            $searchBarPlaceholder,
            $logoText,
            $avatarText,
            $primaryColor,
            $secondaryColor,
            $secondaryActiveColor,
            $footerText,
            $htmlDocumentTemplateComponent,
            $viewWrapperComponent,
        );
    }

    public function createNavRoute(string $name, bool $auth, string $label)
    {
        self::createRoute($this->appTemplateRouteRenderer, strtolower(preg_replace('/([A-Z])/', '-$1', $name)), $name, fn ($params): bool => $auth, [[fn ($params): string => $label, $name]]);
    }

    public function createSubRoute(string $url, string $name, Closure $authResolver, array $breadcrumbs)
    {
        self::createRoute($this->appTemplateRouteRenderer, $url, $name, $authResolver, $breadcrumbs);
    }
}
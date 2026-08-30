<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

use Illuminate\Support\Facades\Route;
use Nozbi\Uikit\BladeComponentRenderer;

final readonly class AppTemplateRouteRenderer
{
    private string $htmlDocumentComponent;
    private string $viewWrapperComponent;

    public function __construct(
        private array $menuItems,
        private ?bool $livewire = null,
        private ?string $avatar = null,
        private ?string $logo = null,
        private ?string $rootRoute = null,
        private ?string $openSideBarText = null,
        private ?string $closeSideBarText = null,
        private ?string $searchBarPlaceholder = null,
        private ?string $logoText = null,
        private ?string $avatarText = null,
        private ?string $primaryColor = null,
        private ?string $secondaryColor = null,
        private ?string $secondaryActiveColor = null,
        private ?string $footerText = null,
        ?string $htmlDocumentComponent = null,
        ?string $viewWrapperComponent = null,
    ) 
    {
        $this->htmlDocumentComponent = $htmlDocumentComponent ?? 'uikit::routed-app-template.html-document';
        $this->viewWrapperComponent = $viewWrapperComponent ?? 'uikit::routed-app-template.view-wrapper';
    }

    public function render(string $view, array $breadcrumbs): string
    {
        $view = BladeComponentRenderer::render($this->viewWrapperComponent, [], ['slot' => $view]);
        return BladeComponentRenderer::render($this->htmlDocumentComponent, ['title' => end($breadcrumbs)[0](request()->route()->parameters())], 
        [
            'slot' => AppTemplateRenderer::render(
                $this->menuItems, 
                $view,
                $this->livewire,
                $this->avatar,
                $this->logo,
                $this->rootRoute,
                $this->openSideBarText,
                $this->closeSideBarText,
                $this->searchBarPlaceholder,
                $this->logoText,
                $this->avatarText,
                $this->primaryColor,
                $this->secondaryColor,
                $this->secondaryActiveColor,
                $this->footerText,
                $breadcrumbs
            )
        ]);
    }
}
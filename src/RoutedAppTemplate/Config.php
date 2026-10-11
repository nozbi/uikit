<?php

namespace Nozbi\Uikit\RoutedAppTemplate;

final readonly class Config
{
    public function __construct(
        public ?bool $livewire,
        public ?string $avatar,
        public ?string $logo,
        public ?string $rootRoute,
        public ?string $openSideBarText,
        public ?string $closeSideBarText,
        public ?string $searchBarPlaceholder,
        public ?string $logoText,
        public ?string $avatarText,
        public ?string $primaryColor,
        public ?string $secondaryColor,
        public ?string $activeColor,
        public ?string $footerText,
        public ?string $htmlDocumentTemplateComponent,
        public ?string $viewWrapperComponent,
    )
    {

    }
}
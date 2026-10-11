<?php

namespace Nozbi\Uikit\App;

use Nozbi\Uikit\RoutedAppTemplateHelper\RoutedAppTemplateHelper;
use Nozbi\Uikit\RoutedAppTemplate\Config as RoutedAppTemplateConfig;

abstract class App
{
    private static App $instance;

    private readonly RoutedAppTemplateHelper $routedAppTemplateHelper;

    private static function callMethod(string $name, ?array $params): mixed
    {
        if ($params !== null)
        {
            return self::$instance->{$name}($params);
        }
        else 
        {
            return self::$instance->{$name}();
        }
    }

    private static function can(string $name, ?array $params): bool
    {
        $name = self::convertToCamelCase($name);
        $methodName = 'can_' . $name;
        if (!method_exists(self::$instance, $methodName) && !self::$instance->isSecured()) 
        {
            return true;
        }
        return self::callMethod($methodName, $params);
    }

    private static function convertToCamelCase(string $kebabCaseString): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $kebabCaseString))));
    }

    public static function canMenuItem(string $name): bool
    {
        return self::can($name, null);
    }

    public static function canSubRoute(string $name, array $params): bool
    {
        return self::can($name, $params);
    }

    public static function getSubRouteLabel(string $name, array $params): string
    {
        $name = self::convertToCamelCase($name);
        $methodName = 'getLabel_' . $name;
        return self::callMethod($methodName, $params);
    }

    public static function render(string $slot): string
    {
        return self::$instance->asBlade($slot);
    }

    public final function __construct()
    {
        $translations = $this->getTranslations();
        $colors = $this->getColors();
        self::$instance = $this;
        $this->routedAppTemplateHelper = new RoutedAppTemplateHelper
        (
            $this->getConfig()->toInternal(),
            fn (): RoutedAppTemplateConfig => new RoutedAppTemplateConfig(
                $this->usesLivewireNavigate(),
                $this->getAvatar(),
                $this->getLogo(),
                $this->getRootRoute(),
                $translations->openSideBarText,
                $translations->closeSideBarText,
                $translations->searchText,
                $translations->logoText,
                $translations->avatarText,
                $colors->primaryColor,
                $colors->secondaryColor,
                $colors->activeColor,
                $translations->footerText,
                $this->getOuterWrapper(),
                $this->getInnerWrapper(),
            ),
        );
    }

    private function asBlade(string $slot): string
    {
        return $this->routedAppTemplateHelper->render($slot);
    }

    protected function usesLivewireNavigate(): bool
    {
        return false;
    }

    protected function isSecured(): bool
    {
        return false;
    }

    protected function getLogo(): ?string
    {
        return null;
    }

    protected function getAvatar(): ?string
    {
        return null;
    }

    protected function getOuterWrapper(): ?string
    {
        return null;
    }

    protected function getInnerWrapper(): ?string
    {
        return null;
    }

    protected function getTranslations(): Translations
    {
        return new Translations('open side bar', 'close side bar', 'Search...', 'logo', 'avatar', '© 2026 UIkit. All rights reserved.');
    }

    protected function getColors(): Colors
    {
        return new Colors('black', 'white', 'red');
    }

    protected abstract function getRootRoute(): string;
    protected abstract function getConfig(): Config;
}
<?php

namespace Nozbi\Uikit\App;

use Nozbi\Uikit\RoutedAppTemplateHelper\RoutedAppTemplateHelper;

abstract class App
{
    private static App $instance;

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
        $methodName = 'can_' . $name;
        if (!method_exists(self::$instance, $methodName) && !self::$instance->isSecured()) 
        {
            return true;
        }
        return self::callMethod($methodName, $params);
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
        $methodName = 'getLabel_' . $name;
        return self::callMethod($methodName, $params);
    }

    public final function __construct()
    {
        $translations = $this->getTranslations();
        $colors = $this->getColors();
        self::$instance = $this;
        new RoutedAppTemplateHelper
        (
            $this->getConfig()->toInternal(),
            $this->usesLivewireNavigate(),
            $this->getAvatar(),
            $this->getLogo(),
            $this->getRootRoute(),
            $this->getOuterWrapper(),
            $this->getInnerWrapper(),
            $colors->primaryColor,
            $colors->secondaryColor,
            $colors->activeColor,
            $translations->openSideBarText,
            $translations->closeSideBarText,
            $translations->searchText,
            $translations->logoText,
            $translations->avatarText,
            $translations->footerText,
        );
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
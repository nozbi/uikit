<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

use Nozbi\Uikit\RoutedAppTemplate\RoutedAppTemplate;
use Closure;

final readonly class RoutedAppTemplateHelper
{
    private static function convertToUrlName(string $name): string
    {
        return strtolower(preg_replace('/([A-Z])/', '-$1', $name));
    }

    private static function registerSubRoutes(?RoutedAppTemplate $routedAppTemplate, array $subRoutes, string $parentUrl, string $parentName, Closure $parentAuthResolver, array $parentBreadcrumbs): void
    {
        foreach ($subRoutes as $subRoute)
        {
            $url = $parentUrl . '/';
            if ($subRoute->isParameterized())
            {
                $url .= '{' . $subRoute->getName() . '}';
            }
            else 
            {
                $url .= self::convertToUrlName($subRoute->getName());
            }
            $fullName = $parentName . '_' . $subRoute->getName();
            $authResolver = $subRoute->getAuthResolver();
            $mergedAuthResolver =  function (array $params) use ($parentAuthResolver, $authResolver): bool 
            {
                return ($parentAuthResolver($params)) && ($authResolver($params));
            };
            $breadcrumbs = $parentBreadcrumbs;
            $breadcrumbs[] = [$subRoute->getLabelResolver(), $fullName];
            $routedAppTemplate->createSubRoute($url, $fullName, $mergedAuthResolver, $breadcrumbs);
            self::registerSubRoutes($routedAppTemplate, $subRoute->getSubRoutes(), $url, $fullName, $mergedAuthResolver, $breadcrumbs);
        }
    }

    public function __construct(
        Menu $menu,
        bool $livewire,
        ?string $avatar,
        ?string $logo,
        ?string $rootRoute,
        ?string $htmlDocumentTemplateComponent,
        ?string $viewWrapperComponent,
        string $primaryColor,
        string $secondaryColor,
        string $secondaryActiveColor,
        string $openSideBarText,
        string $closeSideBarText,
        string $searchText,
        string $logoText,
        string $avatarText,
        string $footerText
    ) 
    {
        $routedAppTemplate = new RoutedAppTemplate
        (
            $menu->toArray(),
            $livewire,
            $avatar,
            $logo,
            $rootRoute,
            $htmlDocumentTemplateComponent,
            $viewWrapperComponent,
            $openSideBarText,
            $closeSideBarText,
            $searchText,
            $logoText,
            $avatarText,
            $primaryColor,
            $secondaryColor,
            $secondaryActiveColor,
            $footerText,
        );
        foreach ($menu->getNavRoutes() as $navRoute)
        {
            self::registerSubRoutes($routedAppTemplate, $navRoute->getSubRoutes(), self::convertToUrlName($navRoute->getName()), $navRoute->getName(), fn (array $params): bool => $navRoute->getAuth(), [[fn (array $params): string => $navRoute->getLabel(), $navRoute->getName()]]);
        }
    }
}
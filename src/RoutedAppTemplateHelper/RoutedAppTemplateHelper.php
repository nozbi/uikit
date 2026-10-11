<?php

namespace Nozbi\Uikit\RoutedAppTemplateHelper;

use Nozbi\Uikit\RoutedAppTemplate\RoutedAppTemplate;
use Closure;

final class RoutedAppTemplateHelper
{
    private readonly RoutedAppTemplate $routedAppTemplate;
    private readonly Menu $menu;
    private array $externalSubRoutesBreadcrumbs = [];

    private static function convertToUrlName(string $name): string
    {
        return strtolower(preg_replace('/([A-Z])/', '-$1', $name));
    }

    private function registerSubRoutes(array $subRoutes, string $parentUrl, string $parentName, Closure $parentAuthResolver, array $parentBreadcrumbs): void
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
            $fullName = $parentName . '.' . $subRoute->getName();
            $authResolver = $subRoute->getAuthResolver();
            $mergedAuthResolver =  function (array $params) use ($parentAuthResolver, $authResolver): bool 
            {
                return ($parentAuthResolver($params)) && ($authResolver($params));
            };
            $breadcrumbs = $parentBreadcrumbs;
            $breadcrumbs[] = [$subRoute->getLabelResolver(), $fullName];
            if ($subRoute->isRouteAlreadyCreated())
            {
                $this->routedAppTemplate->createSubRoute($url, $fullName, $mergedAuthResolver, $breadcrumbs);
            }
            else
            {
                $this->externalSubRoutesBreadcrumbs[$fullName] = $breadcrumbs;
            }
            self::registerSubRoutes($subRoute->getSubRoutes(), $url, $fullName, $mergedAuthResolver, $breadcrumbs);
        }
    }

    public function __construct(Menu $menu, Closure $configResolver) 
    {
        $this->routedAppTemplate = new RoutedAppTemplate($menu->toArray(), $configResolver);
        foreach ($menu->getNavRoutes() as $navRoute)
        {
            self::registerSubRoutes($navRoute->getSubRoutes(), self::convertToUrlName($navRoute->getName()), $navRoute->getName(), $navRoute->getAuthResolver(), [[fn (array $params): string => $navRoute->getLabel(), $navRoute->getName()]]);
        }
        $this->menu = $menu;
    }

    public function render(string $slot): string
    {
        $currentRouteName = request()->route()->getName();
        $currentBreadcrumbs = null;
        if (str_contains($currentRouteName, '.')) 
        {
            $currentBreadcrumbs = $this->externalSubRoutesBreadcrumbs[$currentRouteName];
        } 
        else 
        {
            foreach ($this->menu->getNavRoutes() as $navRoute)
            {
                if ($currentRouteName === $navRoute->getName())
                {
                    $currentBreadcrumbs = [[fn () => $navRoute->getLabel()]];
                    break;
                }
            }
        }
        return $this->routedAppTemplate->render($slot, $currentBreadcrumbs);
    }
}
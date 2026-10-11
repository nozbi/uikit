# Laravel UI kit
## Requirements
- PHP `^8.3`
- Laravel `^13.0`
## Instalation
- Run `composer require nozbi/uikit`
- Add head and body attributes in main layout blade file (if present):
  - `@uikitHead` at end of head
  - `@uikitBody` at end of body
## Compoents:
### App
Component for creating application UI shell and routes.
#### Features
- One configuration for both backend routes and frontend menu
- Responsive design
- Accessibility-first design
- SPA-like experience with state persisted across page reloads and browser navigation
- `Livewire Navigate` ready for a true SPA experience
- Tree structured sidebar menu
- Searchable sidebar menu
- User dropdown menu
- Breadcrumbs
- Fully styled
- Customizable colors
#### Example usage
Create class extending App and create instance of it inside routes/web.php

```php
use Nozbi\Uikit\App\App;
use Nozbi\Uikit\App\Config;
use Nozbi\Uikit\App\Translations;
use Nozbi\Uikit\App\Colors;
use Override;

class MyApp extends App
{
    #[Override]
    protected function usesLivewireNavigate(): bool //return true to enable Livewire Navigate
    {
        return false;
    }

    #[Override]
    protected function isSecured(): bool //return true to require seperate auth method for each config item
    {
        return false;
    }

    #[Override]
    protected function getLogo(): ?string //return logo image path relative to public folder
    {
        return 'images/logo.png';
    }

    #[Override]
    protected function getAvatar(): ?string  //return avatar image path relative to public folder
    {
        return 'images/avatar.png';
    }

    #[Override]
    protected function getOuterWrapper(): ?string //return main app layout blade component name, takes title blade attribute with current route label
    {
        return null;
    }

    #[Override]
    protected function getInnerWrapper(): ?string //return main content wrapper blade component name
    {
        return null;
    }

    #[Override]
    protected function getTranslations(): Translations //return translated texts
    {
        return new Translations('open side bar', 'close side bar', 'Search...', 'logo', 'avatar', '© 2026 UIkit. All rights reserved.');
    }

    #[Override]
    protected function getColors(): Colors //return own colors
    {
        return new Colors('black', 'white', 'red');
    }

    #[Override]
    protected function getRootRoute(): string //return main route
    {
        return 'dashboard';
    }

    #[Override]
    protected function getConfig(): Config //return routing schema
    {
        //all config items takes relative name plus label as first 2 parameters (subroutes dont need to pass label if method for getting label is present)
        //menu route additionaly can take third argument with index inside user menu if its need to be part of it (user menu is one level menu with items ordered by index from lowest to highest) and fourth bool argument that if set to false will not create route
        //route and param routes can take third bool argument that if set to false will not create route
        //keep in mind all names in config must follow laravel route naming convention (kebab case) and are relative to its parent name, so full name is parent name + relative name, connected with dot (.)
        //full item names in methods must have underscores (_) instead of dots (.) and camel case insteab of kebab case 
        //auth methods need full item name prefixed with can_
        //getting label method need full subroute name prefixed with getLabel_
        //both methods optionaly take associative array as parameter with all route parameters
        return new Config()
        ->startMenuRoute('forbidden', 'Forbidden', 0)
            ->route('also-forbidden', 'Also forbidden bescause parent route is forbidden')
        ->endMenuRoute()
        ->startMenu('forbidden-menu', 'Forbidden menu')
            ->menuRoute('also-forbidden', 'Also forbidden bescause parent menu is forbidden')
        ->endMenu()
        ->menuRoute('dashboard', 'Dashboard')
        ->menuRoute('profile', 'Profile', 1)
        ->startMenu('managment', 'Managment')
            ->startMenuRoute('users', 'Users')
                ->route('add', 'Add')
                ->startParamRoute('user')
                    ->Route('edit')
                    ->startParamRoute('roles', 'Roles')
                    ->endParamRoute()
                ->endParamRoute()
            ->endMenuRoute()
        ->endMenu()
        ->menuRoute('not-secured', 'Not secured')
        ;
    }

    protected function can_forbidden()
    {
        return false;
    }

    protected function can_forbidden_alsoForbidden()
    {
        return true;
    }

    protected function can_forbiddenMenu()
    {
        return false;
    }

    protected function can_alsoForbidden()
    {
        return true;
    }

    protected function can_dashboard()
    {
        return true;
    }

    protected function can_profile()
    {
        return true;
    }

    protected function can_managment()
    {
        return true;
    }

    protected function can_users()
    {
        return true;
    }

    protected function can_users_add()
    {
        return true;
    }

    protected function can_users_user(array $params)
    {
        return true;
    }

    protected function can_users_user_edit(array $params)
    {
        return true;
    }

    protected function can_users_user_roles(array $params)
    {
        return true;
    }

    protected function getLabel_users_user(array $params)
    {
        return 'User ' . $params['user'];
    }

    protected function getLabel_users_user_edit(array $params)
    {
        return 'Edit user ' . $params['user'];
    }
}
```

#### Advanced usage
Some packages create their own routing. Instead of overriding external routes it is possible to place app shell as blade component (x-uikit::app) inside external routes views. Component takes slot with route specific content. Component still need a way to receive needed data, such as breadcrumbs or title. In order to achive this, it is needed to declare external routes just like any other route in route config. Only difference is that external routes need to have create route attribute set to false. Keep in mind that auth method specified for external route will apply only for visiblity inside menu, so external route itself need to be properly secured.
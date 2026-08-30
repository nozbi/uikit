<?php

namespace Nozbi\Uikit;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
 
class UikitServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }
 
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'uikit');
        Blade::directive('uikitHead', function () 
        {
            return "<?php echo view('uikit::head-directive')->render(); ?>";
        });
        Blade::directive('uikitBody', function () 
        {
            return "<?php echo view('uikit::body-directive')->render(); ?>";
        });
    }
}
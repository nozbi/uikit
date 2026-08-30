<?php

use Illuminate\Support\Facades\Route;
use Nozbi\Uikit\RouteResourcesBundler;


Route::get('/uikit-script', function () 
{
    return RouteResourcesBundler::bundle('js', 'application/javascript');
});

Route::get('/uikit-style', function () 
{
    return RouteResourcesBundler::bundle('css', 'text/css');
});

Route::get('/uikit-render-listener', function () 
{
    $path = __DIR__ . '/../resources/js/render-listener/render-listener.js';
    return response()->file($path, 
    [
        'Content-Type' => 'application/javascript',
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
});
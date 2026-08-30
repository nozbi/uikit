<?php

namespace Nozbi\Uikit;

class RouteResourcesBundler
{
    public static function bundle(string $folder, string $contentType)
    {
        $files = glob(__DIR__ . "/../resources/{$folder}/*.{$folder}");
        $content = '';
        foreach ($files as $file) 
        {
            $content .= file_get_contents($file) . "\n";
        }
        return response($content, 200)
        ->header('Cache-Control', 'public, max-age=31536000, immutable')
        ->header('Content-Type', $contentType);
    }
}
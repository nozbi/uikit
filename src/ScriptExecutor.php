<?php

namespace Nozbi\Uikit;

class ScriptExecutor
{
    private static array $scripts = [];

    public static function executeScript(string $script): void
    {
        self::$scripts[] = $script;
    }

    public static function execute(string $name, mixed ...$parameters): void
    {
        $script = $name . '(';
        foreach ($parameters as $key => $parameter) 
        {
            if ($key > 0) 
            {
                $script .= ', ';
            }
            $script .= json_encode($parameter);
        }
        $script .= ')';
        self::executeScript($script);
    }

    public static function render(): string
    {
        if (empty(self::$scripts)) {
            return '';
        }
        $js = '';
        foreach (self::$scripts as $script) {
            $js .= $script . ";\n";
        }
        self::$scripts = [];
        return "
            <script>
                renderListener.addRenderListener(" . json_encode($js) . ");
            </script>
        ";
    }
}
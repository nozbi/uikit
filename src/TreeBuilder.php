<?php

namespace Nozbi\Uikit;

use Nozbi\Uikit\BladeComponentRenderer;

class TreeBuilder
{
    private const INTERNAL_HTML_INDEX = 0;
    private const INTERNAL_SUBTREE_INDEX = 1;
    private const INTERNAL_TOGGLED_HTML_INDEX = 2;
    private const INTERNAL_IS_TOGGLED_INDEX = 3;
    private const INTERNAL_LOCAL_STORAGE_KEY_INDEX = 4;
    private const ATTRIBUTES_INDEX = 0;
    private const SUBTREE_INDEX = 1;
    private const IS_TOGGLED_INDEX = 2;
    private const LOCAL_STORAGE_KEY_INDEX = 3;

    private static function wrapNodesInternal(array $nodes, string $nodeComponentName, int $depth) :array
    {
        $internalNodes = [];
        foreach ($nodes as $index => $node) 
        {
            $internalNode = [];
            $attributes = $node[self::ATTRIBUTES_INDEX];
            $attributes['depth'] = $depth;
            $subtree = $node[self::SUBTREE_INDEX] ?? null;
            if ($subtree === null)
            {
                $attributes['isToggle'] = false;
                $internalNode[self::INTERNAL_HTML_INDEX] = BladeComponentRenderer::render($nodeComponentName, $attributes);
            } 
            else
            {
                $attributes['isToggle'] = true;
                $internalNode[self::INTERNAL_HTML_INDEX] = BladeComponentRenderer::render($nodeComponentName, $attributes + ['isToggled' => false]);
                $internalNode[self::INTERNAL_TOGGLED_HTML_INDEX] = BladeComponentRenderer::render($nodeComponentName, $attributes + ['isToggled' => true]);
                $internalNode[self::INTERNAL_IS_TOGGLED_INDEX] = $node[self::IS_TOGGLED_INDEX] ?? false;
                $internalNode[self::INTERNAL_LOCAL_STORAGE_KEY_INDEX] = $node[self::LOCAL_STORAGE_KEY_INDEX] ?? null;
                $internalNode[self::INTERNAL_SUBTREE_INDEX] = self::wrapNodesInternal($subtree, $nodeComponentName, $depth + 1);
            }
            $internalNodes[] = $internalNode;
        }
        return $internalNodes;
    }

    public static function wrapNodes(array $nodes, string $nodeComponentName) :array
    {
        return self::wrapNodesInternal($nodes, $nodeComponentName, 0);
    }
}

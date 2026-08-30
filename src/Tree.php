<?php

namespace Nozbi\Uikit;

class Tree
{
    private const HTML_INDEX = 0;
    private const SUBTREE_INDEX = 1;
    private const TOGGLED_HTML_INDEX = 2;
    private const IS_TOGGLED_INDEX = 3;
    private const LOCAL_STORAGE_KEY_INDEX = 4;

    public static function wrapToggle(string $html, string $toggledHtml, string $subtreeId, bool $isToggled) :string
    {
        return BladeComponentRenderer::render('uikit::tree.subtree-toggle', 
        ['subtreeId' => $subtreeId, 'isToggled' => $isToggled], ['slot' => $html, 'toggledSlot' => $toggledHtml]);
    }

    public static function wrapNodesForPersistingInteractiveTree(array $nodes) :array
    {
        $wrappedNodes = [];
        foreach ($nodes as $node) 
        {
            $subtree = $node[self::SUBTREE_INDEX] ?? null;
            if ($subtree !== null) 
            {
                $localStorageKey = $node[self::LOCAL_STORAGE_KEY_INDEX] ?? null;
                if ($localStorageKey !== null)
                {
                    $html = $node[self::HTML_INDEX];
                    $isToggled = $node[self::IS_TOGGLED_INDEX];
                    $node[self::HTML_INDEX] = BladeComponentRenderer::render('uikit::tree.persisting-subtree-toggle-untoggled-slot-wrapper', ['localStorageKey' => $localStorageKey, 'isToggled' => $isToggled], ['slot' => $html]);
                }
                $node[self::SUBTREE_INDEX] = self::wrapNodesForPersistingInteractiveTree($subtree);
            } 
            $wrappedNodes[] = $node;
        }
        return $wrappedNodes;
    }
}

@props([
    'nodes',
    'nodeComponent'
])

@php
    use Nozbi\Uikit\TreeBuilder;

    $wrappedNodes = TreeBuilder::wrapNodes($nodes, $nodeComponent);
@endphp

<x-uikit::tree.tree :nodes="$wrappedNodes"/>
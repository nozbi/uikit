@props([
    'nodes',
])

@php
    use Nozbi\Uikit\Tree;
@endphp

<x-uikit::panels.vertical-panel>
    @foreach ($nodes as $node)
        @php
            $html = $node[0];
            $subtree = $node[1] ?? null;
            $toggledHtml = $node[2] ?? $html;
            $isToggled = $node[3] ?? null;
            $subtreeId = null;
            if ($subtree !== null)
            {
                $subtreeId = 'customIteractiveTree-' . uniqid();
                $html = Tree::wrapToggle($html, $toggledHtml, $subtreeId, $isToggled);
            }
            $style = '';
            if (!$isToggled)
            {
                $style = 'display:none;';
            }
        @endphp
            <div>
                {!! $html !!}
            </div>
        @if ($subtree !== null)
            <div id="{{ $subtreeId }}" style="{{ $style }}">
                <x-uikit::tree.interactive-tree :nodes="$subtree"/>
            </div>
        @endif
    @endforeach
</x-uikit::panels.vertical-panel>

@props([
    'color',
    'backgroundColor',
    'isForClose',
    'title',
])

<x-uikit::app-template.interactive-panel :color="$color" :background-color="$backgroundColor" :padding="'10'">
    <svg class="uikit-app-template-hamburger" width="24" height="24" viewBox="0 0 24 24">
        <title>{{ $title }}</title>
        @if ($isForClose)
            <path
                d="M1 1 L23 23 M23 1 L1 23"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="butt"
            />
        @else
            <line x1="0.5" y1="4.5"  x2="23.5" y2="4.5"  stroke="currentColor" stroke-width="2" />
            <line x1="0.5" y1="12.5" x2="23.5" y2="12.5" stroke="currentColor" stroke-width="2" />
            <line x1="0.5" y1="20.5" x2="23.5" y2="20.5" stroke="currentColor" stroke-width="2" />
        @endif
    </svg>               
</x-uikit::app-template.interactive-panel>
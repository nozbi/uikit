@props([
    'color',
    'backgroundColor',
    'title',
    'avatar',
])

<x-uikit::app-template.interactive-panel :color="$color" :background-color="$backgroundColor" :padding="2" :transparent="true">
    <div class="uikit-app-template-avatar">
        <img class="uikit-app-template-avatar-image" src="{{ asset($avatar) }}" title="{{ $title }}">
    </div>
</x-uikit::app-template.interactive-panel>
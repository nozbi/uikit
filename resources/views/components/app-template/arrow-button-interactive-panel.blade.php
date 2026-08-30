@props([
    'color',
    'backgroundColor',
    'padding' => null,
    'paddingTop' => 0,
    'paddingBottom' => 0,
    'paddingLeft' => 0,
    'paddingRight' => 0,
    'direction',
])

<x-uikit::app-template.interactive-panel :color="$color" :background-color="$backgroundColor" :padding="$padding" :padding-top="$paddingTop" :padding-bottom="$paddingBottom" :padding-left="$paddingLeft" :padding-right="$paddingRight">
    <x-uikit::app-template.arrow :direction="$direction"/>
</x-uikit::app-template.interactive-panel>        
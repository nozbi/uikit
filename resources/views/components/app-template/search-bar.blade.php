@props([
    'color',
    'placeholderColor',
    'backgroundColor',
    'inputBackgroundColor',
    'placeholder',
    'padding',
    'inputPadding',
    'fontSize',
    'localStorageKey',
])

<x-uikit::app-template.background :color="$backgroundColor" :padding="$padding">
    <input 
        id="uikit-app-template-search-bar-input"
        class="uikit-app-template-search-bar"
        placeholder="{{ $placeholder }}" 
        style="--uikit-app-template-search-bar-placeholder-color:{{ $placeholderColor }}; color:{{ $color }}; font-size:{{ $fontSize }}px; padding:{{ $inputPadding }}px; background-color:{{ $inputBackgroundColor }};"
        type="text" 
    >
</x-uikit::app-template.background>
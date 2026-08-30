@php
    $doc = new \DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<body>' . $slot->toHtml() . '</body>');
    $body = $doc->getElementsByTagName('body')->item(0);
    $elements = [];
    foreach ($body->childNodes as $node) {
        $elements[] = $doc->saveHTML($node);
    }
@endphp

<div class="uikit-layout-horizontal-layout">
    @foreach ($elements as $html)
        <div class="uikit-layout-horizontal-layout-element">
            {!! $html !!}
        </div>
    @endforeach
</div>
@props([
    'route'
])

@php
    $placeholder = str_replace('.', '/', $route) . '.blade.php';
@endphp


<div class="uikit-app-template-router-placeholder">
    {{ $placeholder }}
</div>
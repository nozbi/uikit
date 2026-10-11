@props([
    'route'
])

@php
    $placeholder = $route . '.blade.php';
@endphp


<div class="uikit-app-template-router-placeholder">
    {{ $placeholder }}
</div>
@props([
    'title'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $title }}</title>
    @uikitHead
</head>
<body style="margin:0;">
    {{ $slot }}
    @uikitBody
</body>
</html>
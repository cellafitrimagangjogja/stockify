<!doctype html>
<html lang="en">
<head>
    @include('example_admin.layouts.partials.header')
    @if(auth()->check() && auth()->user()->image)
    <link
        rel="preload"
        as="image"
        href="{{ asset('storage/profile/' . auth()->user()->image) }}">
@endif
</head>

@php
    $whiteBg = isset($params['white_bg']) && $params['white_bg'];
@endphp

<body class="bg-gray-50">

    @yield('main')

    @include('example_admin.layouts.partials.scripts')
    @stack('scripts')

</body>
</html>
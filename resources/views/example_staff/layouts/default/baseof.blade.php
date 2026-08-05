<!doctype html>
<html lang="en" class="dark">
  <head>
    @include('example_staff.layouts.partials.header')
  </head>
  @php
    $whiteBg = isset($params['white_bg']) && $params['white_bg'];
  @endphp

<body class="{{ $whiteBg ? 'bg-white' : 'bg-gray-50' }}">

  @yield('main')
  @include('example_staff.layouts.partials.scripts')
</body>
</html>

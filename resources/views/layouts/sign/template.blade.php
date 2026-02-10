<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @stack('prepend-style')
        @include('includes.sign.style')
    @stack('addon-style')
  </head>
  <body>
    @yield('content')
    @stack('prepend-script')
        @include('includes.sign.script')
    @stack('addon-script')
  </body>
</html>
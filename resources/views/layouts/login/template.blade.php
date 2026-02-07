<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @stack('prepend-style')
        @include('includes.login.style')
    @stack('addon-style')
  </head>
  <body>
    @yield('content')
    @stack('prepend-style')
        @include('includes.login.script')
    @stack('addon-style')
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @stack('prepend-style')
      @include('includes.user.style')
      @include('includes.user.style-blogs')
    @stack('addon-style')
  </head>
  <body>
    @include('includes.user.navbar')
    @yield('content')
    @include('includes.user.footer')

    @stack('prepend-style')
    @include('includes.user.script')
    @stack('addon-script')
  </body>
</html>
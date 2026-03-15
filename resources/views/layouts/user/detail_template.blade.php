<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @stack('prepend-style')
      @include('includes.detail_blog.style')
      @include('includes.detail_blog.style-blogs')
    @stack('addon-style')
  </head>
  <body>
    @include('includes.detail_blog.navbar')
    @yield('content')
    @include('includes.detail_blog.footer')

    @stack('prepend-style')
    @include('includes.detail_blog.script')
    @stack('addon-style')
  </body>
</html>
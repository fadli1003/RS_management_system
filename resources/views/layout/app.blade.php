<!DOCTYPE html>
<html lang="en">
<head>
    <title> @yield('page_title', 'Dashboard') | {{config('app.name', 'RS UNAND' )}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h w-full dark:bg-gray-900 bg-gray-200">
  @include('layout.partials.header')
  <main class="container bg-gray-800 grow gap-4 rounded-xl">
    @yield('section')
  </main>
  @include('layout.partials.footer')
</body>
</html>

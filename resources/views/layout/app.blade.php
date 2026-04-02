<!DOCTYPE html>
<html lang="en">
<head>
    <title> @yield('page_title', 'Dashboard') | {{config('app.name', 'RS UNAND' )}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen w-full dark:bg-gray-900 flex flex-col gap-4 bg-gray-200">
  @include('layout.partials.header')
  <main class="container dark:bg-gray-200 bg-gray-50 grow rounded-xl">
    @yield('section')
  </main>
  @include('layout.partials.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.0/dist/full.css" rel="stylesheet">
    <style>html, body { margin: 0; padding: 0; height: 100%; }</style>
</head>
<body class="h-full w-full bg-gray-100 flex items-center justify-center">
    @yield('content')
</body>
</html>
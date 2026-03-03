<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" />
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    @include('layouts.topbar')

    <div class="flex flex-1 overflow-hidden">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

    @include('layouts.footer')

</body>
</html>
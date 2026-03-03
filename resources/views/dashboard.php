<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Laravel CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" />
</head>
<body class="bg-base-200 min-h-screen">
    <div class="navbar bg-base-100 shadow-md px-10">
        <div class="flex-1">
            <span class="text-xl font-bold">Dashboard</span>
        </div>
        <div class="flex-none">
            <a href="{{ route('logout') }}" class="btn btn-error btn-sm">Logout</a>
        </div>
    </div>
    <div class="flex justify-center items-center mt-20">
        <div class="card w-full max-w-md bg-base-100 shadow-md p-6 text-center">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-2xl font-bold mb-2">
                Welcome, {{ $userName }}
            </h2>
            <p class="text-gray-600">
                You are successfully logged in.
            </p>
        </div>
    </div>
</body>
</html>

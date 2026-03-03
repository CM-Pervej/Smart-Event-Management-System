<header class="bg-white shadow px-4 py-2.5 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Event Management System</h1>
    <div class="flex items-center gap-4">
        <span class="font-medium text-gray-600">
            {{ $userName }}
        </span>
        <div class="avatar">
            <div class="w-10 rounded-full">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}" />
            </div>
        </div>
    </div>
</header>
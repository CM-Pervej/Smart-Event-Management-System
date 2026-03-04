<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-base-200 px-6 py-3 flex justify-between items-center">
    <!-- Left Section -->
    <div class="flex items-center gap-6">
        <!-- Logo / Title -->
        <h1 class="text-2xl font-extrabold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent tracking-wide"> EventMS </h1>
        <!-- Search Bar -->
        <div class="hidden md:flex">
            <label class="input input-bordered flex items-center gap-2 w-80">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
                <input type="text" class="grow" placeholder="Search events, attendees..." />
            </label>
        </div>
    </div>

    <!-- Right Section -->
    <div class="flex items-center gap-4">
        <!-- Notification -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn relative">Notifications 🔔 <span class="absolute top-1 right-1 w-3 h-3 bg-error rounded-full animate-pulse"></span> </label>
            <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-80 bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="font-bold text-lg">Notifications</h3>
                    <ul class="text-sm space-y-2">
                        <li>🎉 New registration for Tech Conference</li>
                        <li>📅 Startup Meetup updated</li>
                        <li>⚠ Payment pending for 2 users</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-6 bg-base-300"></div>

        <!-- User Dropdown -->
        <div class="dropdown dropdown-end">
            <div tabindex="0" class="btn btn-ghost gap-3 px-3 normal-case">
                <!-- Name -->
                <div class="text-left">
                    <div class="font-semibold text-sm">
                        {{ $userName }}
                    </div>

                    @php
                        $roleText = match($userRole) {
                            1 => 'Administrator',
                            2 => 'Organizer',
                            3 => 'Attendee',
                            default => 'Guest',
                        };
                    @endphp

                    <div class="text-xs text-gray-500">
                        {{ $roleText }}
                    </div>
                </div>
            </div>

            <!-- Dropdown Menu -->
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow-lg menu menu-sm dropdown-content bg-base-100 rounded-xl w-52 border border-base-200">
                <li>
                    <a href="{{ route('profile.show', ['id' => request()->cookie('user_id')]) }}" class="hover:text-primary">
                        👤 Profile
                    </a>
                </li>
                <li><a class="hover:text-primary">⚙ Settings</a></li>
                <li class="border-t border-base-200 mt-1 pt-1"> <a class="text-error hover:bg-error hover:text-white rounded-lg">🚪 Logout </a> </li>
            </ul>
        </div>
    </div>
</header>
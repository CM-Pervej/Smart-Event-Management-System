<aside class="w-56 bg-white shadow-lg hidden md:block rounded-r-2xl border border-gray-200">
    <ul class="menu p-4 text-base-content space-y-2">
        <li>
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
               🏠 Dashboard
            </a>
        </li>

        <li>
            <a href="#">
                📅 Events
            </a>
        </li>

        <li>
            <a href="#">
                🎟 Registrations
            </a>
        </li>

        <li>
            <a href="#">
                👥 Users
            </a>
        </li>

        <li>
            <a href="#">
                ⚙ Settings
            </a>
        </li>

        <li class="pt-6">
            <a href="{{ route('logout') }}" class="btn btn-error btn-sm">Logout</a>
        </li>

    </ul>
</aside>
<aside class="w-56 bg-blue-50 shadow-lg hidden md:block rounded-r-2xl border border-gray-200">
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
            <a href="{{ route('organizations.active') }}"  class="{{ request()->routeIs('organizations.*') ? 'active' : '' }}">  
                🎟 Organizations  
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
    </ul>
</aside>
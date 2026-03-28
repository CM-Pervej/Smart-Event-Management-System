<aside class="w-56 bg-white border-r border-gray-200 shadow-lg rounded-r-2xl hidden md:block">

    @php
        $eventMenuOpen = request()->routeIs('events.*') 
            || request()->routeIs('categories.*') 
            || request()->routeIs('subcategories.*');
    @endphp

    <ul class="p-3 space-y-1 text-sm text-gray-700">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}"
               class="relative flex items-center gap-3 px-3 py-2 rounded-lg transition
               {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-black font-medium' : 'hover:bg-gray-50 text-gray-600' }}">
                
                @if(request()->routeIs('dashboard'))
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-1 bg-black rounded-r"></span>
                @endif

                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-black' : 'text-gray-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M3 10.5L12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-10.5z"/>
                </svg>

                Dashboard
            </a>
        </li>

        <!-- EVENTS -->
        <li 
            x-data="{
                open: localStorage.getItem('eventMenu') !== null 
                    ? localStorage.getItem('eventMenu') === 'true' 
                    : {{ $eventMenuOpen ? 'true' : 'false' }}
            }"
            x-init="$watch('open', val => localStorage.setItem('eventMenu', val))"
        >

            <div class="flex items-center justify-between relative">

                <!-- Main Link -->
                <a href="{{ route('events.index') }}"
                   class="flex items-center gap-3 flex-1 px-3 py-2 rounded-lg transition
                   {{ $eventMenuOpen ? 'bg-gray-100 text-black font-medium' : 'hover:bg-gray-50 text-gray-600' }}">

                    @if($eventMenuOpen)
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-1 bg-black rounded-r"></span>
                    @endif

                    <svg class="w-5 h-5 {{ $eventMenuOpen ? 'text-black' : 'text-gray-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                    </svg>

                    Events
                </a>

                <!-- Toggle -->
                <button @click="open = !open"
                        class="p-2 rounded-md hover:bg-gray-100 transition">
                    <svg :class="open ? 'rotate-180' : ''"
                         class="w-4 h-4 text-gray-400 transition-transform duration-200"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>

            <!-- Dropdown -->
            <ul x-show="open"
                x-transition
                class="ml-8 mt-1 space-y-1 border-l border-gray-200 pl-3">

                <!-- Category -->
                <li>
                    <a href="{{ route('categories.index') }}"
                       class="block px-2 py-1.5 rounded-md transition
                       {{ request()->routeIs('categories.*') ? 'bg-gray-100 text-black font-medium' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                        Category
                    </a>
                </li>

                <!-- Sub Category -->
                <li>
                    <a href="{{ route('subcategories.index') }}"
                       class="block px-2 py-1.5 rounded-md transition
                       {{ request()->routeIs('subcategories.*') ? 'bg-gray-100 text-black font-medium' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                        Sub Category
                    </a>
                </li>

            </ul>
        </li>

        <!-- Organizations -->
        <li>
            <a href="{{ route('organizations.active') }}"
               class="relative flex items-center gap-3 px-3 py-2 rounded-lg transition
               {{ request()->routeIs('organizations.*') ? 'bg-gray-100 text-black font-medium' : 'hover:bg-gray-50 text-gray-600' }}">

                @if(request()->routeIs('organizations.*'))
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-1 bg-black rounded-r"></span>
                @endif

                <svg class="w-5 h-5 {{ request()->routeIs('organizations.*') ? 'text-black' : 'text-gray-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M3 21h18"/>
                    <path d="M5 21V7l8-4 8 4v14"/>
                    <path d="M9 9h.01M9 12h.01M9 15h.01M15 9h.01M15 12h.01M15 15h.01"/>
                </svg>

                Organizations
            </a>
        </li>

        <!-- Users -->
        <li>
            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M7 21v-2a4 4 0 0 1 3-3.87"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Users
            </a>
        </li>

        <!-- Settings -->
        <li>
            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1 .6 1.65 1.65 0 0 0-.33 1.82 2 2 0 1 1-3.34 0 1.65 1.65 0 0 0-.33-1.82 1.65 1.65 0 0 0-1-.6 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-.6-1 1.65 1.65 0 0 0-1.82-.33 2 2 0 1 1 0-3.34 1.65 1.65 0 0 0 1.82-.33H4.6a1.65 1.65 0 0 0 .6-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 7.64 3.3l.06.06A1.65 1.65 0 0 0 9 4.6c.36 0 .7-.13 1-.36a1.65 1.65 0 0 0 .33-1.82 2 2 0 1 1 3.34 0 1.65 1.65 0 0 0 .33 1.82c.3.23.64.36 1 .36.36 0 .7-.13 1-.36l.06-.06A2 2 0 1 1 20.7 7.64l-.06.06c-.23.3-.36.64-.36 1 0 .36.13.7.36 1z"/>
                </svg>
                Settings
            </a>
        </li>

    </ul>
</aside>

<script src="//unpkg.com/alpinejs" defer></script>
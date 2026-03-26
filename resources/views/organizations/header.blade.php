{{-- Animate underline & ripple effect --}}
<style>
    @keyframes slideIn {
        0% { width: 0; }
        100% { width: 100%; }
    }
    .animate-slide-in {
        animation: slideIn 0.3s ease-out forwards;
    }

    /* Ripple Effect */
    a .ripple {
        pointer-events: none;
        position: absolute;
        border-radius: 50%;
        background: rgba(99, 102, 241, 0.2); /* Indigo-500 alpha */
        transform: scale(0);
        opacity: 0;
        transition: transform 0.5s, opacity 1s;
    }

    a:active .ripple {
        transform: scale(4);
        opacity: 1;
        transition: transform 0.5s, opacity 1s;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

{{-- organizations/header.blade.php --}}
<div class="bg-white border rounded-t-xl overflow-hidden">
    {{-- Cover --}}
    <div class="relative">
        @if($organization->cover_image)
            <img src="{{ asset('storage/'.$organization->cover_image) }}" class="w-full h-72 object-cover">
        @else
            <div class="w-full h-52 bg-gray-100"></div>
        @endif

        {{-- Logo --}}
        @if($organization->logo)
            <div class="absolute -bottom-8 left-6">
                <img src="{{ asset('storage/'.$organization->logo) }}"
                     class="w-16 h-16 rounded-lg border bg-white p-1 shadow-sm object-cover">
            </div>
        @endif
    </div>

    {{-- Title Row --}}
    <div class="pt-10 pb-5 px-6 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">
                {{ $organization->name }}
            </h1>
            <p class="text-xs text-gray-500 mt-1">
                {{ ucfirst($organization->industry ?? 'N/A') }} · {{ ucfirst($organization->organization_type ?? 'N/A') }}
            </p>
        </div>

        <span class="text-xs px-3 py-1 rounded-md border 
            {{ $organization->status === 'active' ? 'bg-green-50 text-green-600 border-green-200' : 'bg-gray-50 text-gray-500 border-gray-200' }}">
            {{ ucfirst($organization->status) }}
        </span>
    </div>

    {{-- MODULAR PAGE TABS --}}
    @php
        $tabs = [
            'About' => route('organizations.organization', $organization->slug),
            'Events' => route('organizations.organization', $organization->slug),
            'Employees' => route('organizers.organizers', $organization),
            'Sessions' => route('organizations.organization', $organization->slug),
            'Speakers' => route('organizations.organization', $organization->slug),
        ];

        $currentUrl = url()->current();
    @endphp

    {{-- Scrollable Tabs with Shadow & Ripple --}}
    <div class="relative border-b border-gray-200 bg-gray-50">
        <div class="overflow-x-auto scrollbar-hide relative flex">
            <nav class="flex space-x-4 px-6 min-w-max relative">
                @foreach($tabs as $name => $link)
                    @php $isActive = $currentUrl === $link; @endphp
                    <a href="{{ $link }}" 
                       class="relative py-2 px-3 text-sm font-medium whitespace-nowrap
                              overflow-hidden transition-all duration-300 ease-in-out
                              transform {{ $isActive ? 'text-gray-900 font-semibold bg-indigo-50 rounded-md scale-105 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100 hover:rounded-md hover:scale-105' }}">
                        {{ $name }}
                        @if($isActive)
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-500 rounded-full animate-slide-in"></span>
                        @endif
                        <span class="ripple absolute inset-0 rounded-md"></span>
                    </a>
                @endforeach
            </nav>

            {{-- Left & right shadows for scroll --}}
            <div class="pointer-events-none absolute top-0 left-0 h-full w-6 bg-gradient-to-r from-gray-50"></div>
            <div class="pointer-events-none absolute top-0 right-0 h-full w-6 bg-gradient-to-l from-gray-50"></div>
        </div>
    </div>
</div>
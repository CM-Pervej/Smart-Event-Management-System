@extends('layouts.master')

@section('title', $organization->name)

@section('content')
<div class="">

    {{-- HEADER --}}
    <div class="bg-white border rounded-xl overflow-hidden">

        {{-- Cover --}}
        <div class="relative">
            @if($organization->cover_image)
                <img src="{{ asset('storage/'.$organization->cover_image) }}"
                     class="w-full h-52 object-cover">
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
    </div>

    <div class="flex justify-around my-3">
        <a href="">About</a>
        <a href="">Organizations</a>
        <a href="">Events</a>
        <a href="">Employees</a>
        <a href="">Sessions</a>
        <a href="">Speakers</a>
    </div>


    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- About --}}
            <div class="bg-white border rounded-xl p-5">
                <h3 class="text-sm font-semibold text-gray-800 mb-2">About</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $organization->description ?? 'No description provided.' }}
                </p>
            </div>

            {{-- MAP --}}
            @php
                $fullAddress = trim(($organization->address ?? '') . ' ' . ($organization->city ?? '') . ' ' . ($organization->country ?? ''));
                $mapQuery = urlencode($fullAddress);
            @endphp

            @if($fullAddress)
            <div class="bg-white border rounded-xl overflow-hidden">
                <div class="px-5 py-3 border-b text-sm font-semibold text-gray-800">
                    Location
                </div>

                <iframe
                    width="100%"
                    height="250"
                    frameborder="0"
                    style="border:0"
                    src="https://maps.google.com/maps?q={{ $mapQuery }}&output=embed"
                    allowfullscreen>
                </iframe>
            </div>
            @endif

        </div>


        {{-- RIGHT SIDEBAR --}}
        <div class="space-y-6">

            {{-- Info Panel --}}
            <div class="bg-white border rounded-xl p-5">
                <h3 class="text-sm font-semibold text-gray-800 mb-4">Details</h3>

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Owner</span>
                        <span class="text-gray-800 font-medium">{{ $organization->user->name ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Email</span>
                        <span class="text-gray-800">{{ $organization->email ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Phone</span>
                        <span class="text-gray-800">{{ $organization->phone ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="text-gray-500 block mb-1">Website</span>
                        @if($organization->website)
                            <a href="{{ $organization->website }}" target="_blank"
                               class="text-indigo-600 text-sm hover:underline break-all">
                                {{ $organization->website }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </div>

                    <div>
                        <span class="text-gray-500 block mb-1">Address</span>
                        @if($fullAddress)
                            <a href="https://www.google.com/maps?q={{ $mapQuery }}" target="_blank"
                               class="text-gray-800 hover:text-indigo-600 text-sm leading-snug">
                                {{ $fullAddress }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Back --}}
            <a href="{{ route('organizations.active') }}"
               class="block text-center text-sm py-2 border rounded-lg text-gray-600 hover:bg-gray-50 transition">
                ← Back to Organizations
            </a>
        </div>
    </div>
</div>

<!-- MOBILE FLOATING ACTION BUTTONS -->
<div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
    <!-- EDIT -->
    <a href="{{ route('organizations.edit', $organization->slug) }}" class="btn btn-primary btn-circle shadow-xl flex items-center justify-center hover:scale-105 transition tooltip tooltip-left" data-tip="Edit Organization">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6-6M3 21h6l9-9" />
        </svg>
    </a>
    <!-- ADD -->
    <a href="/contact/public/relationships/relatives.php?id=<?= $contact['id'] ?? '' ?>" class="btn btn-success btn-circle shadow-xl flex items-center justify-center hover:scale-105 transition tooltip tooltip-left" data-tip="Add Organization">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </a>
</div>
@endsection
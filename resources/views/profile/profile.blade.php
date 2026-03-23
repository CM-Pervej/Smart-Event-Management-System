@extends('layouts.master')
@section('title', $user->name)

@section('content')
<div class="p-5 bg-white">
    {{-- Main two-column layout --}}
    <div class="flex flex-col md:flex-row md:justify-between gap-8">
        {{-- Left Column: Profile Picture & Basic Info --}}
        <section class="flex gap-6">
            <div>
                {{-- Profile Picture --}}
                @if($user->profile && $user->profile->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                         class="w-40 h-40 object-cover rounded-lg border-4 border-blue-100 shadow-lg"
                         alt="Profile Picture">
                @else
                    <div class="w-40 h-40 bg-gray-200 flex items-center justify-center rounded-lg text-gray-500 text-4xl shadow-inner">
                        <i class="fa-solid fa-user"></i>
                    </div>
                @endif
            </div>

            {{-- Name & Role --}}
            <div class="text-left flex flex-col justify-center">
                <p class="text-4xl font-bold text-gray-900 whitespace-nowrap">{{ $user->name }}</p>
                <p class="text-xl text-gray-500 font-semibold mt-1">
                    @if($user->role == 'admin') Admin
                    @endif
                </p>

                {{-- Contact Info --}}
                <div class="flex gap-2 items-center">
                    <div class="flex flex-col space-y-2 text-gray-600">
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <span><i class="fa-solid fa-phone-volume"></i></span>
                        <span><i class="fa-solid fa-location-dot"></i></span>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <span> <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a> </span>
                        <span> <a href="tel:{{ $user->phone }}" class="text-green-600 hover:underline">{{ $user->phone ?? '-' }}</a> </span>
                        @php
                            $address = $user->profile->address ?? '';
                        @endphp

                        <span>
                            @if(filter_var($address, FILTER_VALIDATE_URL))
                                <a href="{{ $address }}" target="_blank" class="text-purple-600 hover:underline">
                                    {{ $address }}
                                </a>
                            @else
                                <a href="https://www.google.com/maps/search/{{ urlencode($address) }}" 
                                target="_blank" 
                                class="text-purple-600 hover:underline">
                                    {{ $address ?: '-' }}
                                </a>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Right Column: Preferences & Details --}}
        <div class="flex flex-col w-72">
            <!-- job details -->
                <h2 class="text-2xl font-bold border-b mb-2">Job Details</h2>
                <p class="text-justify font-semibold">Title: <span class="font-normal">{{ $user->profile->title ?? '-' }}</span></p>
                <p class="text-justify font-semibold">Department: <span class="font-normal">{{ $user->profile->department ?? '-' }}</span></p>
                <p class="text-justify font-semibold">Company: <span class="font-normal">{{ $user->profile->company ?? '-' }}</span></p>
        </div>
    </div>

    <!-- job details -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold border-y">Preferences</h2>
        <p class="text-justify font-semibold my-2">Accessibility Needs: <span class="font-normal">{{ $user->profile->accessibility_needs ?? 'No Accessibility' }}</span></p>
        <p class="text-justify font-semibold">Dietary Requirements: <span class="font-normal">{{ $user->profile->dietary_requirements ?? 'No Dietary Requirements' }}</span></p>
    </div>
    
    <!-- MOBILE FLOATING ACTION BUTTONS -->
    <div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
        <!-- EDIT -->
        <a href="{{ route('profile.edit', ['id' => request()->cookie('user_id')]) }}" class="btn btn-primary btn-circle shadow-xl flex items-center justify-center hover:scale-105 transition tooltip tooltip-left" data-tip="Edit Profile">
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
</div>
@endsection
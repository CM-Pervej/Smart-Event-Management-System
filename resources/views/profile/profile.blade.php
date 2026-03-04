@extends('layouts.master')

@section('content')
<div class="py-6 px-10 bg-white">
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
            <div class="text-left">
                <p class="text-4xl font-bold text-gray-900 whitespace-nowrap">{{ $user->name }}</p>
                <p class="text-xl text-gray-500 font-semibold mt-1">
                    @if($user->role == 1) Admin
                    @elseif($user->role == 2) Organizer
                    @else Attendee
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
                        <span>
                            <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a>
                        </span>
                        <span>
                            <a href="tel:{{ $user->phone }}" class="text-green-600 hover:underline">{{ $user->phone ?? '-' }}</a>
                        </span>
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
        <div class="flex flex-col gap-4 w-72">
            <!-- job details -->
            <div>
                <h2 class="text-2xl font-bold border-b mb-2">Job Details</h2>
                <p class="text-justify font-semibold">Title: <span class="font-normal">{{ $user->profile->title ?? '-' }}</span></p>
                <p class="text-justify font-semibold">Department: <span class="font-normal">{{ $user->profile->department ?? '-' }}</span></p>
                <p class="text-justify font-semibold">Company: <span class="font-normal">{{ $user->profile->company ?? '-' }}</span></p>
            </div>
        </div>
    </div>

    <!-- job details -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold border-y">Preferences</h2>
        <p class="text-justify font-semibold my-2">Accessibility Needs: <span class="font-normal">{{ $user->profile->accessibility_needs ?? 'No Accessibility' }}</span></p>
        <p class="text-justify font-semibold">Dietary Requirements: <span class="font-normal">{{ $user->profile->dietary_requirements ?? 'No Dietary Requirements' }}</span></p>
    </div>
    <a href="{{ route('profile.edit', ['id' => request()->cookie('user_id')]) }}" class="hover:text-primary"> 👤 Profile </a>

</div>
@endsection
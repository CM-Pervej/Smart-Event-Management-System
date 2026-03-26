@extends('layouts.master')
@section('title', $user->name)

@section('content')
<div class="p-5 bg-gray-50 min-h-screen">

    {{-- PROFILE & JOB --}}
    <div class="flex flex-col md:flex-row md:justify-between gap-8 bg-white p-6 rounded-xl shadow-md">
        {{-- LEFT: Profile Picture & Info --}}
        <section class="flex items-center gap-6">
            <div>
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

            <div class="flex flex-col justify-center">
                <p class="text-4xl font-bold text-gray-900">{{ $user->name }}</p>
                <p class="text-xl text-gray-500 font-semibold mt-1">
                    @if($user->role == 'admin') Admin
                    @endif
                </p>

                {{-- Contact --}}
                <div class="flex gap-2 items-center mt-2">
                    <div class="flex flex-col space-y-2 text-gray-600">
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <span><i class="fa-solid fa-phone-volume"></i></span>
                        <span><i class="fa-solid fa-location-dot"></i></span>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <span><a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a></span>
                        <span><a href="tel:{{ $user->phone }}" class="text-green-600 hover:underline">{{ $user->phone ?? '-' }}</a></span>
                        @php $address = $user->profile->address ?? '-' @endphp
                        <span>
                            <a href="https://www.google.com/maps/search/{{ urlencode($address) }}" target="_blank" class="text-purple-600 hover:underline">
                                {{ $address }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        {{-- RIGHT: Job Details --}}
        <div class="flex flex-col w-72 bg-gray-50 p-4 rounded-lg shadow-inner">
            <h2 class="text-2xl font-bold border-b mb-2">Job Details</h2>
            <p class="font-semibold">Title: <span class="font-normal">{{ $user->profile->title ?? '-' }}</span></p>
            <p class="font-semibold">Department: <span class="font-normal">{{ $user->profile->department ?? '-' }}</span></p>
            <p class="font-semibold">Company: <span class="font-normal">{{ $user->profile->company ?? '-' }}</span></p>
        </div>
    </div>

    {{-- PREFERENCES --}}
    <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold border-b pb-2">Preferences</h2>
        <div class="flex justify-between font-semibold pt-2">
            <div class="flex-1">
                <p>Accessibility Needs:</p> 
                <p class="font-normal">{{ $user->profile->accessibility_needs ?? 'No Accessibility' }}</p>
            </div>
            <div class="flex-1">
                <p>Dietary Requirements:</p> 
                <p class="font-normal">{{ $user->profile->dietary_requirements ?? 'No Dietary Requirements' }}</p>
            </div>
        </div>
    </div>

    {{-- ORGANIZATIONS --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Active Organizations --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold border-b mb-4 text-green-600">Active Organizations</h2>
            @if($activeOrgs->count())
                <div class="space-y-4">
                    @foreach($activeOrgs as $org)
                        <div class="flex items-center p-3 border rounded-lg hover:shadow-lg transition">
                            @if($org->logo)
                                <img src="{{ asset('storage/' . $org->logo) }}" class="w-12 h-12 rounded-full mr-4 object-cover">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-full mr-4 flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('organizations.organization', $org->slug) }}" class="font-semibold text-blue-600 hover:underline">
                                    {{ $org->name }}
                                </a>
                                <p class="text-gray-500 text-sm">{{ Str::limit($org->description, 80) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No active organizations yet.</p>
            @endif
        </div>

        {{-- Inactive Organizations --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold border-b mb-4 text-red-600">Inactive Organizations</h2>
            @if($inactiveOrgs->count())
                <div class="space-y-4">
                    @foreach($inactiveOrgs as $org)
                        <div class="flex items-center p-3 border rounded-lg hover:shadow-lg transition">
                            @if($org->logo)
                                <img src="{{ asset('storage/' . $org->logo) }}" class="w-12 h-12 rounded-full mr-4 object-cover">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-full mr-4 flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('organizations.organization', $org->slug) }}" class="font-semibold text-blue-600 hover:underline">
                                    {{ $org->name }}
                                </a>
                                <p class="text-gray-500 text-sm">{{ Str::limit($org->description, 80) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No inactive organizations yet.</p>
            @endif
        </div>
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
        <a href="{{ route('organizations.create') }}" class="btn btn-success btn-circle shadow-xl flex items-center justify-center hover:scale-105 transition tooltip tooltip-left" data-tip="Add Organization"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> 
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /> 
            </svg> 
        </a> 
    </div>
</div>
@endsection
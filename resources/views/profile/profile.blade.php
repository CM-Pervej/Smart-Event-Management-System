@extends('layouts.master')
@section('title', $user->name)

@section('content')

<div class="min-h-screen bg-base-200">

    <div class="relative">

        {{-- Gradient banner --}}
        <div class="h-52 sm:h-64 w-full bg-gradient-to-br from-primary via-secondary to-accent overflow-hidden relative">
            {{-- Dot-grid texture --}}
            <div class="absolute inset-0 opacity-[0.08]"
                 style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:28px 28px;"></div>
            {{-- Glassy orbs for depth --}}
            <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-white opacity-5 blur-2xl"></div>
            <div class="absolute top-10 right-10 w-56 h-56 rounded-full bg-white opacity-5 blur-2xl"></div>
        </div>

        {{-- Floating profile card --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative -mt-20 sm:-mt-24 z-10">
                <div class="card bg-base-100 shadow-2xl border border-base-300 rounded-3xl overflow-hidden">
                    <div class="card-body p-5 sm:p-8">

                        <div class="flex flex-col lg:flex-row lg:items-start gap-6">

                            {{-- ── Avatar + identity ── --}}
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 flex-1">

                                {{-- Avatar with ring & status --}}
                                <div class="relative flex-shrink-0">
                                    @if($user->profile && $user->profile->profile_picture)
                                        <div class="avatar">
                                            <div class="w-20 sm:w-24 rounded-2xl ring-4 ring-base-100 shadow-xl">
                                                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                                     alt="{{ $user->name }}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar placeholder">
                                            <div class="w-20 sm:w-24 rounded-2xl ring-4 ring-base-100 shadow-xl
                                                        bg-gradient-to-br from-primary to-secondary text-primary-content">
                                                <span class="text-3xl font-bold">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Online status dot --}}
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-success rounded-full
                                                border-2 border-base-100 shadow-sm"></div>
                                </div>

                                {{-- Name / role / contact --}}
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-base-content leading-tight">
                                            {{ $user->name }}
                                        </h1>
                                        @if($user->role === 'admin')
                                            <div class="badge badge-primary gap-1 font-semibold px-3 py-3 text-xs">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 1l2.39 4.84 5.35.78-3.87 3.77.91 5.32L10 13.27l-4.78 2.44.91-5.32L2.26 6.62l5.35-.78L10 1z"/>
                                                </svg>
                                                Admin
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Job title line --}}
                                    @if($user->profile->title ?? false)
                                        <p class="text-base-content/60 font-medium text-sm mb-3">
                                            {{ $user->profile->title }}
                                            @if($user->profile->company ?? false)
                                                <span class="text-base-content/30 mx-1">·</span>
                                                {{ $user->profile->company }}
                                            @endif
                                        </p>
                                    @endif

                                    {{-- Contact pills --}}
                                    <div class="flex flex-wrap gap-2">
                                        <a href="mailto:{{ $user->email }}"
                                           class="inline-flex items-center gap-1.5 text-xs font-medium
                                                  px-3 py-1.5 rounded-full bg-base-200 hover:bg-primary
                                                  hover:text-primary-content border border-base-300
                                                  hover:border-primary transition-all duration-200 group
                                                  text-base-content no-underline">
                                            <svg class="w-3 h-3 opacity-50 group-hover:opacity-100" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $user->email }}
                                        </a>

                                        @if($user->phone)
                                            <a href="tel:{{ $user->phone }}"
                                               class="inline-flex items-center gap-1.5 text-xs font-medium
                                                      px-3 py-1.5 rounded-full bg-base-200 hover:bg-success
                                                      hover:text-success-content border border-base-300
                                                      hover:border-success transition-all duration-200 group
                                                      text-base-content no-underline">
                                                <svg class="w-3 h-3 opacity-50 group-hover:opacity-100" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $user->phone }}
                                            </a>
                                        @endif

                                        @php $address = $user->profile->address ?? null; @endphp
                                        @if($address)
                                            <a href="https://www.google.com/maps/search/{{ urlencode($address) }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1.5 text-xs font-medium
                                                      px-3 py-1.5 rounded-full bg-base-200 hover:bg-secondary
                                                      hover:text-secondary-content border border-base-300
                                                      hover:border-secondary transition-all duration-200 group
                                                      text-base-content no-underline">
                                                <svg class="w-3 h-3 opacity-50 group-hover:opacity-100" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $address }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- ── Stat counters (right side) ── --}}
                            <div class="flex lg:flex-col gap-3 lg:gap-2 flex-shrink-0">
                                {{-- Active orgs --}}
                                <div class="flex-1 lg:flex-none min-w-0 bg-success/10 border border-success/20
                                            rounded-2xl px-5 py-3 text-center lg:text-left lg:min-w-[120px]">
                                    <div class="text-2xl font-black text-success leading-none">
                                        {{ $activeOrgs->count() }}
                                    </div>
                                    <div class="text-xs font-semibold text-success/70 uppercase tracking-wider mt-0.5">
                                        Active
                                    </div>
                                </div>
                                {{-- Past orgs --}}
                                <div class="flex-1 lg:flex-none min-w-0 bg-base-200 border border-base-300
                                            rounded-2xl px-5 py-3 text-center lg:text-left lg:min-w-[120px]">
                                    <div class="text-2xl font-black text-base-content/40 leading-none">
                                        {{ $inactiveOrgs->count() }}
                                    </div>
                                    <div class="text-xs font-semibold text-base-content/30 uppercase tracking-wider mt-0.5">
                                        Past
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-32 mt-6 space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- Job Details (wider) --}}
            <div class="lg:col-span-3 card bg-base-100 border border-base-300 shadow-lg rounded-3xl">
                <div class="card-body p-6 sm:p-8">

                    {{-- Section header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h2 class="font-black text-base-content text-base uppercase tracking-widest text-xs">
                            Job Details
                        </h2>
                    </div>

                    {{-- Detail rows --}}
                    <div class="space-y-3">

                        {{-- Title --}}
                        <div class="group flex items-center gap-4 p-4 rounded-2xl bg-base-200
                                    hover:bg-primary/5 hover:border-primary/20 border border-transparent
                                    transition-all duration-200 cursor-default">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0
                                        group-hover:bg-primary group-hover:shadow-lg transition-all duration-200">
                                <svg class="w-4 h-4 text-primary group-hover:text-primary-content transition-colors duration-200"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-0.5">Title</p>
                                <p class="font-semibold text-base-content text-sm truncate">
                                    {{ $user->profile->title ?? '—' }}
                                </p>
                            </div>
                        </div>

                        {{-- Department --}}
                        <div class="group flex items-center gap-4 p-4 rounded-2xl bg-base-200
                                    hover:bg-secondary/5 hover:border-secondary/20 border border-transparent
                                    transition-all duration-200 cursor-default">
                            <div class="w-10 h-10 rounded-xl bg-secondary/10 flex items-center justify-center flex-shrink-0
                                        group-hover:bg-secondary group-hover:shadow-lg transition-all duration-200">
                                <svg class="w-4 h-4 text-secondary group-hover:text-secondary-content transition-colors duration-200"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-0.5">Department</p>
                                <p class="font-semibold text-base-content text-sm truncate">
                                    {{ $user->profile->department ?? '—' }}
                                </p>
                            </div>
                        </div>

                        {{-- Company --}}
                        <div class="group flex items-center gap-4 p-4 rounded-2xl bg-base-200
                                    hover:bg-accent/5 hover:border-accent/20 border border-transparent
                                    transition-all duration-200 cursor-default">
                            <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0
                                        group-hover:bg-accent group-hover:shadow-lg transition-all duration-200">
                                <svg class="w-4 h-4 text-accent group-hover:text-accent-content transition-colors duration-200"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-0.5">Company</p>
                                <p class="font-semibold text-base-content text-sm truncate">
                                    {{ $user->profile->company ?? '—' }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Preferences (narrower) --}}
            <div class="lg:col-span-2 card bg-base-100 border border-base-300 shadow-lg rounded-3xl">
                <div class="card-body p-6 sm:p-8">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-success/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-success" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h2 class="font-black text-base-content text-base uppercase tracking-widest text-xs">
                            Preferences
                        </h2>
                    </div>

                    <div class="space-y-4">

                        {{-- Accessibility --}}
                        <div class="rounded-2xl bg-base-200 p-4 border border-base-300">
                            <p class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-2">
                                <span class="mr-1">♿</span> Accessibility
                            </p>
                            <span class="badge badge-primary badge-outline text-xs font-semibold py-2.5 px-3">
                                {{ $user->profile->accessibility_needs ?? 'No requirements' }}
                            </span>
                        </div>

                        {{-- Dietary --}}
                        <div class="rounded-2xl bg-base-200 p-4 border border-base-300">
                            <p class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-2">
                                <span class="mr-1">🥗</span> Dietary
                            </p>
                            <span class="badge badge-success badge-outline text-xs font-semibold py-2.5 px-3">
                                {{ $user->profile->dietary_requirements ?? 'No requirements' }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ── Active Organizations ── --}}
            <div class="card bg-base-100 border border-base-300 shadow-lg rounded-3xl">
                <div class="card-body p-6 sm:p-8">

                    {{-- Header with count badge --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-success/10 flex items-center justify-center">
                                <div class="w-2.5 h-2.5 rounded-full bg-success animate-pulse"></div>
                            </div>
                            <h2 class="text-xs font-black uppercase tracking-widest text-success">
                                Active Organizations
                            </h2>
                        </div>
                        <div class="badge badge-success text-xs font-bold px-2.5">
                            {{ $activeOrgs->count() }}
                        </div>
                    </div>

                    @if($activeOrgs->count())
                        <div class="space-y-2">
                            @foreach($activeOrgs as $org)
                                <a href="{{ route('organizations.organization', $org->slug) }}"
                                   class="group flex items-center gap-3 p-3 rounded-2xl border border-base-200
                                          bg-base-200 hover:bg-base-100 hover:border-success/40
                                          hover:shadow-md transition-all duration-200 no-underline">

                                    {{-- Org logo / placeholder --}}
                                    @if($org->logo)
                                        <div class="avatar flex-shrink-0">
                                            <div class="w-10 h-10 rounded-xl shadow-sm overflow-hidden">
                                                <img src="{{ asset('storage/' . $org->logo) }}"
                                                     alt="{{ $org->name }}" class="object-cover w-full h-full">
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar placeholder flex-shrink-0">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-success to-accent
                                                        text-success-content shadow-sm flex items-center justify-center">
                                                <span class="text-sm font-bold">
                                                    {{ strtoupper(substr($org->name, 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Org info --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-base-content group-hover:text-success
                                                   transition-colors truncate">
                                            {{ $org->name }}
                                        </p>
                                        @if($org->description)
                                            <p class="text-xs text-base-content/40 truncate mt-0.5">
                                                {{ Str::limit($org->description, 55) }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Arrow --}}
                                    <svg class="w-4 h-4 text-base-content/20 group-hover:text-success
                                                group-hover:translate-x-0.5 transition-all duration-200 flex-shrink-0"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    @else
                        {{-- Empty state --}}
                        <div class="flex flex-col items-center justify-center py-10 rounded-2xl
                                    border-2 border-dashed border-base-300 text-base-content/25">
                            <svg class="w-10 h-10 mb-3" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                            </svg>
                            <p class="text-sm font-semibold">No active organizations</p>
                            <a href="{{ route('organizations.create') }}"
                               class="mt-3 btn btn-success btn-sm btn-outline rounded-full gap-1 text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add one
                            </a>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ── Past / Inactive Organizations ── --}}
            <div class="card bg-base-100 border border-base-300 shadow-lg rounded-3xl">
                <div class="card-body p-6 sm:p-8">

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-base-300 flex items-center justify-center">
                                <div class="w-2.5 h-2.5 rounded-full bg-base-content/30"></div>
                            </div>
                            <h2 class="text-xs font-black uppercase tracking-widest text-base-content/50">
                                Past Organizations
                            </h2>
                        </div>
                        <div class="badge badge-ghost text-xs font-bold px-2.5">
                            {{ $inactiveOrgs->count() }}
                        </div>
                    </div>

                    @if($inactiveOrgs->count())
                        <div class="space-y-2">
                            @foreach($inactiveOrgs as $org)
                                <a href="{{ route('organizations.organization', $org->slug) }}"
                                   class="group flex items-center gap-3 p-3 rounded-2xl border border-base-200
                                          bg-base-200 hover:bg-base-100 hover:border-base-content/20
                                          hover:shadow-md transition-all duration-200 no-underline opacity-75 hover:opacity-100">

                                    @if($org->logo)
                                        <div class="avatar flex-shrink-0">
                                            <div class="w-10 h-10 rounded-xl shadow-sm overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-200">
                                                <img src="{{ asset('storage/' . $org->logo) }}"
                                                     alt="{{ $org->name }}" class="object-cover w-full h-full">
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar placeholder flex-shrink-0">
                                            <div class="w-10 h-10 rounded-xl bg-base-300 text-base-content/40
                                                        shadow-sm flex items-center justify-center">
                                                <span class="text-sm font-bold">
                                                    {{ strtoupper(substr($org->name, 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-base-content/60 group-hover:text-base-content
                                                   transition-colors truncate">
                                            {{ $org->name }}
                                        </p>
                                        @if($org->description)
                                            <p class="text-xs text-base-content/30 truncate mt-0.5">
                                                {{ Str::limit($org->description, 55) }}
                                            </p>
                                        @endif
                                    </div>

                                    <svg class="w-4 h-4 text-base-content/15 group-hover:text-base-content/50
                                                group-hover:translate-x-0.5 transition-all duration-200 flex-shrink-0"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 rounded-2xl
                                    border-2 border-dashed border-base-300 text-base-content/25">
                            <svg class="w-10 h-10 mb-3" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                            </svg>
                            <p class="text-sm font-semibold">No past organizations</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<div class="fixed bottom-6 right-6 z-50 flex flex-col-reverse items-end gap-3">

    {{-- Edit Profile --}}
    <a href="{{ route('profile.edit', ['id' => request()->cookie('user_id')]) }}"
       class="btn btn-primary shadow-xl rounded-full gap-2 px-5
              hover:-translate-y-0.5 hover:shadow-2xl transition-all duration-200 group no-underline">
        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-200"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Edit Profile
    </a>

    {{-- New Organization --}}
    <a href="{{ route('organizations.create') }}"
       class="btn btn-success shadow-xl rounded-full gap-2 px-5
              hover:-translate-y-0.5 hover:shadow-2xl transition-all duration-200 group no-underline">
        <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        New Organization
    </a>

</div>

@endsection
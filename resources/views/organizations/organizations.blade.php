@extends('layouts.master')

@section('title', 'Organizations')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        {{-- Left --}}
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Organizations</h2>
            <p class="text-gray-500 text-sm mt-1">Manage and explore organizations</p>
        </div>

        {{-- Right --}}
        <div class="flex items-center gap-3">

            {{-- Toggle Tabs --}}
            <div class="flex border rounded-lg overflow-hidden text-sm">
                <a href="{{ route('organizations.active') }}"
                class="px-4 py-2 
                {{ request()->routeIs('organizations.active') 
                        ? 'bg-gray-900 text-white' 
                        : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                    Active
                </a>

                <a href="{{ route('organizations.inactive') }}"
                class="px-4 py-2 border-l
                {{ request()->routeIs('organizations.inactive') 
                        ? 'bg-gray-900 text-white' 
                        : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                    Inactive
                </a>
            </div>

            {{-- Create Button --}}
            <a href="{{ route('organizations.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                + Create
            </a>

        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Empty State --}}
    @if($organizations->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border">
            <h3 class="text-lg font-semibold text-gray-700">No organizations found</h3>
            <p class="text-gray-500 text-sm mt-2">Start by creating your first organization 🚀</p>
        </div>
    @else

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($organizations as $org)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border hover:shadow-xl transition duration-300">

                    {{-- Cover --}}
                    <div class="relative">
                        @if($org->cover_image)
                            <img src="{{ asset('storage/'.$org->cover_image) }}"
                                 class="h-44 w-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="h-44 bg-gradient-to-r from-gray-100 to-gray-200"></div>
                        @endif

                        {{-- Logo --}}
                        @if($org->logo)
                            <div class="absolute -bottom-6 left-5">
                                <img src="{{ asset('storage/'.$org->logo) }}"
                                     class="h-12 w-12 rounded-xl border-4 border-white shadow-md object-cover">
                            </div>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="pt-10 pb-5 px-5">
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                            {{ $org->name }}
                        </h3>

                        @if($org->description)
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                                {{ Str::limit($org->description, 90) }}
                            </p>
                        @endif

                        {{-- Info --}}
                        <div class="mt-4 space-y-1 text-sm text-gray-600">
                            <p><span class="font-medium text-gray-700">Type:</span> {{ ucfirst($org->organization_type ?? 'N/A') }}</p>
                            <p><span class="font-medium text-gray-700">Industry:</span> {{ ucfirst($org->industry ?? 'N/A') }}</p>
                            <p><span class="font-medium text-gray-700">Owner:</span> {{ $org->user->name ?? 'N/A' }}</p>
                        </div>

                        {{-- Footer --}}
                        <div class="flex justify-between items-center mt-6">
                            <span class="text-xs text-gray-400">
                                {{ $org->email ?? 'No email' }}
                            </span>

                            <a href="{{ route('organizations.organization', $org->slug) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                View →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endif

</div>
@endsection
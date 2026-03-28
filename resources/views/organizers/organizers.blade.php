@extends('layouts.master')
@section('title', 'Employees of ' . $organization->name)

@section('content')

@include('organizations.header')

<div class="max-w-7xl mx-auto p-6 space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Employees</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $organization->name }}</p>
        </div>

        <div class="flex items-center gap-3">
            {{-- <a href="{{ route('organizers.inactive', $organization) }}"
               class="px-4 py-2 rounded-lg border bg-white hover:bg-gray-50 text-sm font-medium shadow-sm transition">
                Inactive Employees
            </a> --}}

            <a href="{{ route('organizers.create', $organization) }}"
               class="px-5 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold shadow hover:bg-blue-700 transition">
                + Assign Employee
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 shadow-sm">
            <span>✅</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Employee Cards Grid -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($employees as $employee)
        <div class="relative bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 overflow-hidden">

            <!-- Card Top / Image -->
            <div class="relative">
                <img src="{{ $employee->user->profile?->profile_picture ? asset('storage/'.$employee->user->profile->profile_picture) : 'https://i.pravatar.cc/150?u='.$employee->user->email }}" 
                     class="w-full h-40 object-cover">

                <!-- Hover Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 hover:opacity-100 transition flex flex-col justify-center items-center text-white px-3 text-center">
                    <p class="text-sm">{{ $employee->user->profile?->title ?? '' }}</p>
                    <p class="text-xs">{{ $employee->user->profile?->department ?? '' }}</p>
                    <p class="text-xs">{{ $employee->user->profile?->company ?? '' }}</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-4 flex flex-col items-center text-center">

                <h2 class="text-lg font-semibold truncate">{{ $employee->user->name }}</h2>
                <p class="text-gray-500 text-sm truncate">{{ $employee->user->email }}</p>

                <!-- Contact -->
                <a href="tel:{{ $employee->user->phone ?? '' }}" 
                    class="mt-2 px-4 py-1 bg-blue-50 text-blue-600 text-sm rounded-full hover:bg-blue-100 transition">
                    {{ $employee->user->phone ?? 'No Contact' }}
                </a>
            </div>
            
            <div class="flex justify-between items-center">
                <!-- Role Badge -->
                <span class="px-3 py-1 text-xs font-medium
                    @if($employee->role == 'admin') text-red-600
                    @elseif($employee->role == 'manager') text-yellow-700
                    @else text-gray-600 @endif">
                    {{ ucfirst($employee->role) }}
                </span>

                <a href="{{ route('profile.show', ['id' => $employee->user->id]) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                    View →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full flex flex-col items-center gap-3 text-gray-400 py-16">
            <div class="text-4xl">👥</div>
            <p class="text-sm">No employees assigned yet</p>
            <a href="{{ route('organizers.create', $organization) }}"
               class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm shadow hover:bg-blue-700 transition">
               Assign First Employee
            </a>
        </div>
        @endforelse

    </div>
</div>

@endsection
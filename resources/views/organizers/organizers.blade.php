@extends('layouts.master')
@section('title', 'Employees of ' . $organization->name)

@section('content')

@include('organizations.header')

<div class="max-w-7xl mx-auto space-y-6 p-6">
    <!-- 🔷 Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Employees</h1>
            <p class="text-sm text-gray-500">{{ $organization->name }}</p>
        </div>

        <a href="{{ route('organizers.create', $organization) }}" 
           class="btn btn-primary shadow-md">
            ➕ Assign Employees
        </a>
    </div>

    <!-- ✅ Success Alert -->
    @if(session('success'))
        <div class="p-3 rounded-lg bg-green-50 text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- 📊 Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white border rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">Total Employees</p>
            <h3 class="text-xl font-bold">{{ count($employees) }}</h3>
        </div>

        <div class="bg-white border rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">Active</p>
            <h3 class="text-xl font-bold">
                {{ $employees->where('status', 1)->count() }}
            </h3>
        </div>

        <div class="bg-white border rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">Admins</p>
            <h3 class="text-xl font-bold">
                {{ $employees->where('role', 'admin')->count() }}
            </h3>
        </div>

        <div class="bg-white border rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">Managers</p>
            <h3 class="text-xl font-bold">
                {{ $employees->where('role', 'manager')->count() }}
            </h3>
        </div>
    </div>

    <!-- 📋 Table -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        <div class="p-5 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">Employee List</h2>

            <!-- 🔍 (optional future search) -->
            <input type="text" placeholder="Search..." 
                   class="input input-bordered input-sm w-60">
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($employees as $index => $employee)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3 text-gray-500">
                            {{ $index + 1 }}
                        </td>

                        <td class="font-medium">
                            {{ $employee->user->name }}
                        </td>

                        <td class="text-sm text-gray-500">
                            {{ $employee->user->email }}
                        </td>

                        <!-- 🎭 Role Badge -->
                        <td>
                            @if($employee->role == 'admin')
                                <span class="badge badge-error badge-sm">👑 Admin</span>
                            @elseif($employee->role == 'manager')
                                <span class="badge badge-warning badge-sm">🧑‍💼 Manager</span>
                            @else
                                <span class="badge badge-ghost badge-sm">👨‍🔧 Staff</span>
                            @endif
                        </td>

                        <!-- ✅ Status -->
                        <td>
                            @if($employee->status)
                                <span class="text-green-600 text-sm font-medium">
                                    ● Active
                                </span>
                            @else
                                <span class="text-gray-400 text-sm">
                                    ● Inactive
                                </span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10">

                            <div class="flex flex-col items-center gap-2 text-gray-400">
                                <i class="fa-solid fa-users text-3xl"></i>
                                <p>No employees assigned yet</p>

                                <a href="{{ route('organizers.create', $organization) }}" 
                                   class="btn btn-sm btn-primary mt-2">
                                    Assign Now
                                </a>
                            </div>

                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
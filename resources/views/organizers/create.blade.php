@extends('layouts.master')
@section('title', 'Manage Employees')

@section('content')

@include('organizations.header')

<div class="max-w-7xl mx-auto space-y-6 p-6">

    <!-- 🔷 Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">
                Manage Employees
            </h1>
            <p class="text-gray-500 text-sm">
                {{ $organization->name }}
            </p>
        </div>

        <button form="employeeForm" class="btn btn-primary shadow-md">
            💾 Save Changes
        </button>
    </div>

    <form id="employeeForm" method="POST" action="{{ route('organizers.store', $organization) }}">
        @csrf

        <!-- ========================= -->
        <!-- ✅ ASSIGNED EMPLOYEES -->
        <!-- ========================= -->
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Assigned Employees</h2>
                <span class="text-sm text-gray-400">
                    {{ count($assignedOrganizers) }} members
                </span>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">

                @forelse($assignedOrganizers as $index => $organizer)
                <div class="group border rounded-xl p-4 hover:shadow-md transition">

                    <div class="flex justify-between items-start">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input 
                                type="checkbox"
                                name="users[assigned_{{ $index }}][id]"
                                value="{{ $organizer->user->id }}"
                                checked
                                class="checkbox checkbox-primary"
                            >
                            <span class="font-semibold">
                                {{ $organizer->user->name }}
                            </span>
                        </label>

                        <span class="badge badge-success badge-sm">
                            Active
                        </span>
                    </div>

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $organizer->user->email }}
                    </p>

                    <!-- Role -->
                    <div class="mt-3">
                        <select name="users[assigned_{{ $index }}][role]" 
                                class="select select-bordered w-full select-sm">

                            <option value="admin" {{ $organizer->role == 'admin' ? 'selected' : '' }}>
                                👑 Admin
                            </option>

                            <option value="manager" {{ $organizer->role == 'manager' ? 'selected' : '' }}>
                                🧑‍💼 Manager
                            </option>

                            <option value="staff" {{ $organizer->role == 'staff' ? 'selected' : '' }}>
                                👨‍🔧 Staff
                            </option>

                        </select>
                    </div>

                    <p class="text-xs text-red-400 mt-2 opacity-0 group-hover:opacity-100 transition">
                        Uncheck to remove access
                    </p>

                </div>
                @empty
                <p class="text-gray-400">No assigned employees</p>
                @endforelse

            </div>
        </div>

        <!-- ========================= -->
        <!-- ➕ AVAILABLE USERS -->
        <!-- ========================= -->
        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Add Employees</h2>

                <!-- 🔍 Search -->
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="Search users..."
                    class="input input-bordered input-sm w-64"
                >
            </div>

            <div id="userList" class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">

                @foreach($availableUsers as $index => $user)
                <div class="user-card border rounded-xl p-4 hover:shadow-md transition">

                    <label class="flex items-center gap-2 mb-2 cursor-pointer">
                        <input 
                            type="checkbox"
                            name="users[new_{{ $index }}][id]"
                            value="{{ $user->id }}"
                            class="checkbox checkbox-primary"
                        >
                        <span class="user-name font-semibold">
                            {{ $user->name }}
                        </span>
                    </label>

                    <p class="user-email text-xs text-gray-400 mb-3">
                        {{ $user->email }}
                    </p>

                    <!-- Role -->
                    <select name="users[new_{{ $index }}][role]" 
                            class="select select-bordered select-sm w-full">
                        <option value="">Assign Role</option>
                        <option value="admin">👑 Admin</option>
                        <option value="manager">🧑‍💼 Manager</option>
                        <option value="staff">👨‍🔧 Staff</option>
                    </select>

                </div>
                @endforeach

            </div>

        </div>

    </form>
</div>

<!-- 🔥 LIVE SEARCH -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let search = this.value.toLowerCase();

    document.querySelectorAll('.user-card').forEach(card => {
        let name = card.querySelector('.user-name').innerText.toLowerCase();
        let email = card.querySelector('.user-email').innerText.toLowerCase();

        card.style.display = (name.includes(search) || email.includes(search)) 
            ? 'block' 
            : 'none';
    });
});
</script>

@endsection
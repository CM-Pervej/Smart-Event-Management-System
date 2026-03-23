@extends('layouts.master')
@section('title', $user->name)

@section('content')
<div class="p-5 bg-white">
    <h2 class="text-2xl font-bold mb-6">Your Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- USER DATA --}}
            <div>
                <label class="block font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            {{-- PROFILE DATA --}}
            <div>
                <label class="block font-semibold">Company</label>
                <input type="text" name="company"
                       value="{{ old('company', $user->profile->company ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold">Department</label>
                <input type="text" name="department"
                       value="{{ old('department', $user->profile->department ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold">Title</label>
                <input type="text" name="title"
                       value="{{ old('title', $user->profile->title ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">Address</label>
                <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', $user->profile->address ?? '') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">Dietary Requirements</label>
                <textarea name="dietary_requirements" class="w-full border rounded px-3 py-2">{{ old('dietary_requirements', $user->profile->dietary_requirements ?? '') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">Accessibility Needs</label>
                <textarea name="accessibility_needs" class="w-full border rounded px-3 py-2">{{ old('accessibility_needs', $user->profile->accessibility_needs ?? '') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">Profile Picture</label>
                <input type="file" name="profile_picture" class="w-full border rounded px-3 py-2">

                @if($user->profile && $user->profile->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                         class="w-24 h-24 mt-3 rounded-full object-cover">
                @endif
            </div>

        </div>

        <div class="mt-6">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
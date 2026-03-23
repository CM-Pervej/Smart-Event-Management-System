@extends('layouts.master')

@section('title', 'Edit Organization')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900">Edit organization</h2>
        <p class="text-sm text-gray-500 mt-1">Update your organization details</p>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-6 text-sm text-red-600">
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organizations.update', $organization->slug) }}" 
          method="POST" enctype="multipart/form-data" 
          class="space-y-8">
        @csrf
        @method('PUT')

        {{-- BASIC --}}
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name"
                       value="{{ old('name', $organization->name) }}"
                       class="w-full px-3 py-2 text-sm border rounded-md focus:ring-1 focus:ring-gray-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description"
                          class="w-full px-3 py-2 text-sm border rounded-md focus:ring-1 focus:ring-gray-900"
                          rows="4">{{ old('description', $organization->description) }}</textarea>
            </div>
        </div>

        <div class="border-t"></div>

        {{-- CONTACT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <input type="email" name="email"
                   value="{{ old('email', $organization->email) }}"
                   placeholder="Email"
                   class="px-3 py-2 text-sm border rounded-md">

            <input type="text" name="phone"
                   value="{{ old('phone', $organization->phone) }}"
                   placeholder="Phone"
                   class="px-3 py-2 text-sm border rounded-md">

            <div class="md:col-span-2">
                <input type="url" name="website"
                       value="{{ old('website', $organization->website) }}"
                       placeholder="Website"
                       class="w-full px-3 py-2 text-sm border rounded-md">
            </div>
        </div>

        <div class="border-t"></div>

        {{-- LOCATION --}}
        <div class="space-y-4">
            <input type="text" name="address"
                   value="{{ old('address', $organization->address) }}"
                   placeholder="Address"
                   class="w-full px-3 py-2 text-sm border rounded-md">

            <div class="grid grid-cols-2 gap-5">
                <input type="text" name="city"
                       value="{{ old('city', $organization->city) }}"
                       placeholder="City"
                       class="px-3 py-2 text-sm border rounded-md">

                <input type="text" name="country"
                       value="{{ old('country', $organization->country) }}"
                       placeholder="Country"
                       class="px-3 py-2 text-sm border rounded-md">
            </div>
        </div>

        <div class="border-t"></div>

        {{-- MEDIA --}}
        <div class="space-y-4">

            {{-- Logo --}}
            <div>
                <label class="text-sm text-gray-600">Logo</label>

                @if($organization->logo)
                    <img src="{{ asset('storage/'.$organization->logo) }}"
                         class="w-16 h-16 object-cover rounded mb-2">
                @endif

                <input type="file" name="logo"
                       class="w-full text-sm border rounded-md">
            </div>

            {{-- Cover --}}
            <div>
                <label class="text-sm text-gray-600">Cover</label>

                @if($organization->cover_image)
                    <img src="{{ asset('storage/'.$organization->cover_image) }}"
                         class="w-full h-32 object-cover rounded mb-2">
                @endif

                <input type="file" name="cover_image"
                       class="w-full text-sm border rounded-md">
            </div>

        </div>

        {{-- ACTION --}}
        <div class="flex justify-between pt-4">
            <a href="{{ route('organizations.organization', $organization->slug) }}"
               class="text-sm text-gray-500 hover:text-gray-700">
                Cancel
            </a>

            <button type="submit"
                    class="px-4 py-2 text-sm bg-gray-900 text-white rounded-md hover:bg-gray-800">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Create Organization')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900">Create organization</h2>
        <p class="text-sm text-gray-500 mt-1">Add basic information about your organization</p>
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

    <form action="{{ route('organizations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- BASIC --}}
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description"
                          class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none"
                          rows="4"></textarea>
            </div>
        </div>

        <div class="border-t"></div>

        {{-- CONTACT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                <input type="url" name="website"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
            </div>
        </div>

        <div class="border-t"></div>

        {{-- LOCATION --}}
        <div class="space-y-5">
            <input type="text" name="address" placeholder="Street address"
                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">

            <div class="grid grid-cols-2 gap-5">
                <input type="text" name="city" placeholder="City"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">

                <input type="text" name="country" placeholder="Country"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
            </div>
        </div>

        <div class="border-t"></div>

        {{-- CLASSIFICATION --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Organization type</label>
                <select name="organization_type"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none"
                        onchange="toggleTypeInput(this)">
                    <option value="">Select</option>
                    <option value="Company">Company</option>
                    <option value="NGO">NGO</option>
                    <option value="Club">Club</option>
                    <option value="Education">Education</option>
                    <option value="other">Other</option>
                </select>

                <input type="text" name="organization_type_custom"
                       placeholder="Custom type"
                       class="w-full mt-2 px-3 py-2 text-sm border border-gray-300 rounded-md hidden"
                       id="type_custom">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                <select name="industry"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none"
                        onchange="toggleIndustryInput(this)">
                    <option value="">Select</option>
                    <option value="Technology">Technology</option>
                    <option value="Education">Education</option>
                    <option value="Health">Healthcare</option>
                    <option value="Finance">Finance</option>
                    <option value="other">Other</option>
                </select>

                <input type="text" name="industry_custom"
                       placeholder="Custom industry"
                       class="w-full mt-2 px-3 py-2 text-sm border border-gray-300 rounded-md hidden"
                       id="industry_custom">
            </div>

        </div>

        <div class="border-t"></div>

        {{-- MEDIA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                <input type="file" name="logo"
                       class="w-full text-sm border border-gray-300 rounded-md file:mr-3 file:px-3 file:py-1 file:border-0 file:bg-gray-100">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover image</label>
                <input type="file" name="cover_image"
                       class="w-full text-sm border border-gray-300 rounded-md file:mr-3 file:px-3 file:py-1 file:border-0 file:bg-gray-100">
            </div>
        </div>

        {{-- ACTION --}}
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('organizations.active') }}"
               class="text-sm text-gray-500 hover:text-gray-700">
                Cancel
            </a>

            <button type="submit"
                    class="px-4 py-2 text-sm font-medium bg-gray-900 text-white rounded-md hover:bg-gray-800 transition">
                Create
            </button>
        </div>

    </form>
</div>

<script>
function toggleTypeInput(select) {
    document.getElementById('type_custom').classList.toggle('hidden', select.value !== 'other');
}

function toggleIndustryInput(select) {
    document.getElementById('industry_custom').classList.toggle('hidden', select.value !== 'other');
}
</script>
@endsection
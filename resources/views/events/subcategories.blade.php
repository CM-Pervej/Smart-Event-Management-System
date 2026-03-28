@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6" x-data="subCategoryCrud()">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Sub-categories</h1>
            <p class="text-sm text-gray-500">Manage your event sub-categories</p>
        </div>

        <button @click="$refs.nameInput.focus()"
            class="bg-black text-white px-4 py-2 rounded-xl text-sm hover:bg-gray-800 transition">
            + New Sub-category
        </button>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="px-4 py-3 bg-green-100 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-sm border p-5 space-y-5">

        <!-- Form -->
        <form :action="isEditing ? '/events/subcategories/' + editId : '{{ route('subcategories.store') }}'" 
              method="POST"
              class="flex flex-col md:flex-row gap-3 items-end">
            @csrf
            <template x-if="isEditing">
                <input type="hidden" name="_method" value="PUT">
            </template>

            <!-- Name Input -->
            <input type="text"
                name="name"
                x-model="name"
                x-ref="nameInput"
                placeholder="Enter sub-category name..."
                class="flex-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-black focus:outline-none">

            <!-- Category Dropdown -->
            <select name="category_id"
                x-model="category_id"
                class="flex-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-black focus:outline-none">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" x-bind:selected="category_id == {{ $cat->id }}">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit"
                    class="px-5 py-2 rounded-xl text-white text-sm transition"
                    :class="isEditing 
                        ? 'bg-blue-600 hover:bg-blue-700' 
                        : 'bg-black hover:bg-gray-800'">

                    <span x-text="isEditing ? 'Update' : 'Add'"></span>
                </button>

                <button type="button"
                    x-show="isEditing"
                    @click="resetForm()"
                    class="px-4 py-2 bg-gray-100 rounded-xl hover:bg-gray-200 text-sm">
                    Cancel
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="border-t"></div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="text-gray-500 text-xs uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Sub-category</th>
                        <th class="px-4 py-3 text-left">Category</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($subCategories as $sub)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $sub->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $sub->category->name ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-right space-x-2">

                                <!-- Edit -->
                                <button 
                                    @click="editCategory({{ $sub->id }}, '{{ $sub->name }}', {{ $sub->category_id }})"
                                    class="px-3 py-1 text-xs bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100">
                                    Edit
                                </button>

                                <!-- Delete -->
                                <button 
                                    @click="openDeleteModal({{ $sub->id }})"
                                    class="px-3 py-1 text-xs bg-red-50 text-red-600 rounded-lg hover:bg-red-100">
                                    Delete
                                </button>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12">

                                <div class="flex flex-col items-center gap-2">
                                    <div class="text-gray-300 text-5xl">📂</div>
                                    <p class="text-gray-500">No sub-categories yet</p>
                                    <button @click="$refs.nameInput.focus()"
                                        class="text-sm text-black underline">
                                        Create your first sub-category
                                    </button>
                                </div>

                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form x-ref="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal"
         x-transition
         class="fixed inset-0 flex items-center justify-center bg-black/40 z-50">

        <div @click.outside="showDeleteModal = false"
             class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 space-y-4">

            <h2 class="text-lg font-semibold text-gray-800">
                Delete Sub-category
            </h2>

            <p class="text-sm text-gray-500">
                Are you sure you want to delete this sub-category? This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3 pt-4">

                <button @click="showDeleteModal = false"
                    class="px-4 py-2 text-sm bg-gray-100 rounded-lg hover:bg-gray-200">
                    Cancel
                </button>

                <button @click="confirmDelete()"
                    class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete
                </button>

            </div>
        </div>
    </div>

</div>

<!-- AlpineJS -->
<script>
function subCategoryCrud() {
    return {
        name: '',
        category_id: '',
        editId: null,
        isEditing: false,

        showDeleteModal: false,
        deleteId: null,

        editCategory(id, name, cat_id) {
            this.name = name;
            this.category_id = cat_id;
            this.editId = id;
            this.isEditing = true;

            this.$nextTick(() => {
                this.$refs.nameInput.focus();
            });
        },

        resetForm() {
            this.name = '';
            this.category_id = '';
            this.editId = null;
            this.isEditing = false;
        },

        openDeleteModal(id) {
            this.deleteId = id;
            this.showDeleteModal = true;
        },

        confirmDelete() {
            let form = this.$refs.deleteForm;
            form.action = `/events/subcategories/${this.deleteId}`;
            form.submit();
        }
    }
}
</script>
@endsection
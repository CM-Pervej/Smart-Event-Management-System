@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6" x-data="categoryCrud()">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Categories</h1>
            <p class="text-sm text-gray-500">Manage your event categories</p>
        </div>

        <button @click="$refs.nameInput.focus()"
            class="bg-black text-white px-4 py-2 rounded-xl text-sm hover:bg-gray-800 transition">
            + New Category
        </button>
    </div>

    <!-- Success -->
    @if(session('success'))
        <div class="px-4 py-3 bg-green-100 text-green-700 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-sm border p-5 space-y-5">

        <!-- Form -->
        <form :action="isEditing ? '/events/categories/' + editId : '{{ route('categories.store') }}'" 
              method="POST"
              class="flex flex-col md:flex-row gap-3">
            @csrf

            <template x-if="isEditing">
                <input type="hidden" name="_method" value="PUT">
            </template>

            <input type="text"
                name="name"
                x-model="name"
                x-ref="nameInput"
                placeholder="Enter category name..."
                class="flex-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-black focus:outline-none">

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
                        <th class="px-4 py-3 text-left">Category</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $category->name }}
                            </td>

                            <td class="px-4 py-3 text-right space-x-2">

                                <!-- Edit -->
                                <button 
                                    @click="editCategory({{ $category->id }}, '{{ $category->name }}')"
                                    class="px-3 py-1 text-xs bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100">
                                    Edit
                                </button>

                                <!-- Delete -->
                                <button 
                                    @click="openDeleteModal({{ $category->id }})"
                                    class="px-3 py-1 text-xs bg-red-50 text-red-600 rounded-lg hover:bg-red-100">
                                    Delete
                                </button>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-12">

                                <div class="flex flex-col items-center gap-2">
                                    <div class="text-gray-300 text-5xl">📂</div>
                                    <p class="text-gray-500">No categories yet</p>
                                    <button @click="$refs.nameInput.focus()"
                                        class="text-sm text-black underline">
                                        Create your first category
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
                Delete Category
            </h2>

            <p class="text-sm text-gray-500">
                Are you sure you want to delete this category? This action cannot be undone.
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

<!-- Alpine Logic -->
<script>
function categoryCrud() {
    return {
        name: '',
        editId: null,
        isEditing: false,

        showDeleteModal: false,
        deleteId: null,

        editCategory(id, name) {
            this.name = name;
            this.editId = id;
            this.isEditing = true;

            this.$nextTick(() => {
                this.$refs.nameInput.focus();
            });
        },

        resetForm() {
            this.name = '';
            this.editId = null;
            this.isEditing = false;
        },

        openDeleteModal(id) {
            this.deleteId = id;
            this.showDeleteModal = true;
        },

        confirmDelete() {
            let form = this.$refs.deleteForm;
            form.action = `/events/categories/${this.deleteId}`;
            form.submit();
        }
    }
}
</script>
@endsection
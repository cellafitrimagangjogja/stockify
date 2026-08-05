@extends('example_admin.layouts.default.dashboard')

@section('title', 'Edit Kategori')

@section('content')

      <div class="container mx-auto px-6 py-6">

      <h1 class="text-2xl font-bold mb-5">
            Edit Kategori
      </h1>

      <form action="{{ route('admin.categories.update', $category->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow p-6">

                  <hr class="my-6">

                  <div class="mb-4">
                  <label>Nama Kategori</label>

                  <input
                        type="text"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="w-full border rounded p-2">
                  </div>

                  <!-- Deskripsi -->
                  <div class="mb-4">

                  <label>Deskripsi</label>

                  <input
                        type="text"
                        name="description"
                        value="{{ old('description', $category->description) }}"
                        class="w-full border rounded p-2">

                  </div>

                  

                  <!-- Tombol -->
                  <div class="flex gap-3 mt-8">

                  <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                        Update

                  </button>

                  <a href="{{ route('admin.categories.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Kembali

                  </a>

                  </div>

            </div>

      </form>

</div>

      @endsection
    
</script>
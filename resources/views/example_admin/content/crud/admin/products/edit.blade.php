@extends('example_admin.layouts.default.dashboard')

@section('title', 'Edit Produk')

@section('content')

      <div class="container mx-auto px-6 py-6">

      <h1 class="text-2xl font-bold mb-5">
            Edit Produk
      </h1>

      <form action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow p-6">

                  <!-- Preview Gambar -->
                  <div class="flex flex-col items-start mb-6">

                  <div class="inline-flex border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 p-2">

                  <img
                        id="preview-image"
                        src="{{ $product->image
                              ? asset('storage/products/' . $product->image)
                              : 'https://placehold.co/250x250?text=No+Image' }}"
                        class="max-w-full h-auto object-contain"
                        alt="{{ $product->name }}">

                  </div>

                  <label class="mt-4 text-sm font-medium">
                        Ganti Gambar Produk
                  </label>

                  <input type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="mt-2 block w-full max-w-xs">

                  </div>

                  <hr class="my-6">

                  <!-- Nama Produk -->
                  <div class="mb-4">
                  <label>Nama Produk</label>

                  <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="w-full border rounded p-2">
                  </div>

                  <!-- Kategori -->
                  <div class="mb-4">

                  <label>Kategori</label>

                  <select name="category_id"
                              class="w-full border rounded p-2">

                        @foreach($categories as $category)

                              <option value="{{ $category->id }}"
                              {{ $product->category_id == $category->id ? 'selected' : '' }}>

                              {{ $category->name }}

                              </option>

                        @endforeach

                  </select>

                  </div>

                  <!-- Supplier -->
                  <div class="mb-4">

                  <label>Supplier</label>

                  <select name="supplier_id"
                              class="w-full border rounded p-2">
                        
                        @foreach($suppliers as $supplier)

                              <option value="{{ $supplier->id }}"
                              {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>

                              {{ $supplier->name }}

                              </option>

                        @endforeach

                  </select>

                  </div>

                  <!-- SKU -->
                  <div class="mb-4">

                  <label>SKU</label>

                  <input
                        type="text"
                        name="sku"
                        value="{{ old('sku', $product->sku) }}"
                        class="w-full border rounded p-2">

                  </div>

                  <!-- Deskripsi -->
                  <div class="mb-4">

                  <label>Deskripsi</label>

                  <textarea
                        name="description"
                        rows="4"
                        class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>

                  </div>

                  <!-- Harga -->
                  <div class="grid grid-cols-2 gap-4">

                  <div>

                        <label>Harga Beli</label>

                        <input
                              type="number"
                              name="purchase_price"
                              value="{{ old('purchase_price', $product->purchase_price) }}"
                              class="w-full border rounded p-2">

                  </div>

                  <div>

                        <label>Harga Jual</label>

                        <input
                              type="number"
                              name="selling_price"
                              value="{{ old('selling_price', $product->selling_price) }}"
                              class="w-full border rounded p-2">

                  </div>

                  </div>

                  <!-- Stok -->
                  <div class="mt-4">

                  <label>Stok Minimum</label>

                  <input
                        type="number"
                        name="minimum_stock"
                        value="{{ old('minimum_stock', $product->minimum_stock) }}"
                        class="w-full border rounded p-2">

                  </div>

                  <!-- Tombol -->
                  <div class="flex gap-3 mt-8">

                  <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                        Update

                  </button>

                  <a href="{{ route('admin.products.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Kembali

                  </a>

                  </div>

            </div>

      </form>

      <script>
      document.getElementById('image').addEventListener('change', function(e) {

      const file = e.target.files[0];

      if (file) {
            document.getElementById('preview-image').src =
                  URL.createObjectURL(file);
      }

      });
      </script>

</div>

      @endsection
     @push('scripts')
            <script>
            document.getElementById('image').addEventListener('change', function(e){

            const reader = new FileReader();

            reader.onload = function(event){
                  document.getElementById('preview-image').src = event.target.result;
            }

            if(e.target.files.length > 0){
                  reader.readAsDataURL(e.target.files[0]);
            }

            });
            </script>
      @endpush
</script>
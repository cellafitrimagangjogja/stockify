@extends('example.layouts.default.dashboard')

@section('title', 'Tambah Produk')

@section('content')

<div class="container mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Produk
    </h1>

    <form action="{{ route('manajer.products.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

                <div class="bg-white rounded-lg shadow p-6">

                    <!-- Preview Gambar -->
                    <!-- Preview Gambar -->
                    <!--<div class="flex flex-col items-start mb-6">-->

                        <div class="w-56 h-56 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">

                            <img
                                id="preview-image"
                                src="https://placehold.co/224x224?text=No+Image"
                                class="w-full h-full object-cover">

                        </div>
                </div>
                        <div>
                                <label>Upload Gambar</label>

                                <input type="file"
                                    id="image"
                                    name="image"
                                    accept="image/*"
                                    class="w-full">
                        </div>

                    <hr class="my-6">

                    <div class="grid grid-cols-2 gap-8 w-full">

                    <!-- Nama Produk -->
                    <div class="col-span-2">
                        <label>Nama Produk</label>

                        <input
                            type="text"
                            name="name"
                            class="mt-2 w-full border rounded-lg p-3">
                    </div>

                    <!-- Kategori -->
                    <div>

                        <label>Kategori</label>

                        <select
                            name="category_id"
                            class="mt-2 w-full border rounded-lg p-3">

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- Supplier -->
                    <div>

                        <label>Supplier</label>

                        <select
                            name="supplier_id"
                            class="mt-2 w-full border rounded-lg p-3">

                            <option value="">-- Pilih Supplier --</option>

                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- SKU -->
                    <div>

                        <label>SKU</label>

                        <input
                            type="text"
                            name="sku"
                            class="mt-2 w-full border rounded-lg p-3">

                    </div>

                    <!-- Stok Minimum -->
                    <div>

                        <label>Stok Minimum</label>

                        <input
                            type="number"
                            name="minimum_stock"
                            class="mt-2 w-full border rounded-lg p-3">

                    </div>

                    <!-- Harga Beli -->
                    <div>

                        <label>Harga Beli</label>

                        <input
                            type="number"
                            name="purchase_price"
                            class="mt-2 w-full border rounded-lg p-3">

                    </div>

                    <!-- Harga Jual -->
                    <div>

                        <label>Harga Jual</label>

                        <input
                            type="number"
                            name="selling_price"
                            class="mt-2 w-full border rounded-lg p-3">

                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2">

                        <label>Deskripsi</label>

                        <textarea
                            rows="5"
                            name="description"
                            class="mt-2 w-full border rounded-lg p-3"></textarea>

                    </div>
                        
                <!-- Tombol -->
                    <div class="flex gap-3 mt-8">

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Simpan

                        </button>

                        <a href="{{ route('manajer.products.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Kembali

                        </a>

                    </div>

                </div>    
        </form>

</div>


<script>
const input = document.getElementById('image');
const preview = document.getElementById('preview-image');

input.addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
    }
});
</script>

@endsection
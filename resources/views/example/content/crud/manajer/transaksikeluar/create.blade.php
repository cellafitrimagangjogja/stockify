@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        Tambah Transaksi Barang Keluar
    </h1>

    <div class="bg-white p-6 rounded-lg shadow">

        <form action="{{ route('transaksi-barangkeluar.store') }}" method="POST">
            @csrf

            {{-- Produk --}}
            <div class="mb-4">
                <label class="block mb-2">
                    Produk
                </label>

                <select name="product_id"
                        class="w-full p-2.5 border rounded-lg"
                        required>

                    <option value="">-- Pilih Produk --</option>

                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} - {{ $product->sku }}
                        </option>
                    @endforeach

                </select>
            </div>


            {{-- Jumlah --}}
            <div class="mb-4">
                <label class="block mb-2">
                    Jumlah
                </label>

                <input type="number"
                    name="quantity"
                    min="1"
                    class="w-full p-2.5 border rounded-lg"
                    required>
            </div>


            {{-- Tanggal --}}
            <div class="mb-4">
                <label class="block mb-2">
                    Tanggal Transaksi
                </label>

                <input
                type="date"
                id="date"
                name="date"
                value="{{ old('date', date('Y-m-d')) }}"
                class="w-full p-2.5 border border-gray-300 rounded-lg"
                required>
            </div>


            {{-- Catatan --}}
            <div class="mb-4">
                <label class="block mb-2">
                    Catatan
                </label>

                <textarea name="notes"
                        class="w-full p-2.5 border rounded-lg"></textarea>
            </div>


            <div class="flex gap-2">

                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-lg">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
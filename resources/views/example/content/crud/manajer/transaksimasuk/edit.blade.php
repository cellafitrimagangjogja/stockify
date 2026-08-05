@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Edit Transaksi Barang Masuk
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Ubah data transaksi barang masuk.
        </p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">

        <form action="{{ route('transaksi-barangmasuk.update', $transaksibarangmasuk->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- Produk --}}
            <div class="mb-5">

                <label for="product_id"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Produk
                </label>

                <select
                    id="product_id"
                    name="product_id"
                    class="w-full p-2.5 border border-gray-300 rounded-lg"
                    required>

                    <option value="">-- Pilih Produk --</option>

                    @foreach($products as $product)

                        <option value="{{ $product->id }}"
                            {{ $transaksibarangmasuk->product_id == $product->id ? 'selected' : '' }}>

                            {{ $product->name }} - {{ $product->sku }}

                        </option>

                    @endforeach

                </select>

                @error('product_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Jumlah --}}
            <div class="mb-5">

                <label for="quantity"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Jumlah Barang
                </label>

                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    min="1"
                    value="{{ old('quantity', $transaksibarangmasuk->quantity) }}"
                    class="w-full p-2.5 border border-gray-300 rounded-lg"
                    required>

                @error('quantity')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tanggal --}}
            <div class="mb-5">

                <label for="date"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Tanggal Transaksi
                </label>

                <input
                    type="date"
                    id="date"
                    name="date"
                    value="{{ old('date', $transaksibarangmasuk->date) }}"
                    class="w-full p-2.5 border border-gray-300 rounded-lg"
                    required>

                @error('date')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Status --}}
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Status
                </label>

                <input
                    type="text"
                    value="{{ $transaksibarangmasuk->status }}"
                    class="w-full p-2.5 bg-gray-100 border border-gray-300 rounded-lg"
                    readonly>

                <p class="mt-1 text-xs text-gray-500">
                    Status hanya dapat diubah oleh Staff Gudang melalui proses konfirmasi.
                </p>

            </div>


            {{-- Catatan --}}
            <div class="mb-6">

                <label for="notes"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Catatan
                </label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="4"
                    class="w-full p-2.5 border border-gray-300 rounded-lg"
                    placeholder="Masukkan catatan">{{ old('notes', $transaksibarangmasuk->notes) }}</textarea>

                @error('notes')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex gap-3">

                <a href="{{ route('transaksi-barangmasuk.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
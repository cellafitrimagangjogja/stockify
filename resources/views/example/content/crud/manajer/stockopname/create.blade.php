@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        Tambah Stock Opname
    </h1>

    <div class="bg-white rounded-lg shadow p-6">

        <form action="{{ route('stockopname.store') }}"
              method="POST">

            @csrf


            {{-- Produk --}}
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Produk
                </label>

                <select name="product_id"
                        class="w-full p-2.5 border border-gray-300 rounded-lg"
                        required>

                    <option value="">
                        -- Pilih Produk --
                    </option>

                    @foreach($products as $product)

                        <option value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

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


            {{-- Stok Fisik --}}
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Stok Fisik
                </label>

                <input type="number"
                       name="physical_stock"
                       value="{{ old('physical_stock') }}"
                       min="0"
                       class="w-full p-2.5 border border-gray-300 rounded-lg"
                       required>

                @error('physical_stock')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tanggal --}}
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Tanggal Opname
                </label>

                <input type="date"
                       name="opname_date"
                       value="{{ old('opname_date', date('Y-m-d')) }}"
                       class="w-full p-2.5 border border-gray-300 rounded-lg"
                       required>

            </div>


            {{-- Catatan --}}
            <div class="mb-6">

                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Catatan
                </label>

                <textarea name="note"
                          rows="4"
                          class="w-full p-2.5 border border-gray-300 rounded-lg"
                          placeholder="Masukkan catatan jika ada">{{ old('note') }}</textarea>

            </div>


            {{-- Tombol --}}
            <div class="flex gap-2">

                <a href="{{ route('stockopname.index') }}"
                   class="px-5 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600">

                    Kembali

                </a>

                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
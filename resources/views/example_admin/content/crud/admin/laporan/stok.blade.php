@extends('example_admin.layouts.default.dashboard')

@section('title', 'Laporan Stok Barang')

@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-green-900">
            Laporan Stok Barang
        </h1>

        <p class="text-gray-500">
            Menampilkan laporan stok barang berdasarkan periode dan kategori.
        </p>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">

        <form action="{{ route('admin.laporan.stok') }}" method="GET">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                {{-- Tanggal Mulai --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-green-900">
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="w-full border rounded-lg p-2.5"
                    >
                </div>

                {{-- Tanggal Akhir --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-green-900">
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="w-full border rounded-lg p-2.5"
                    >
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-green-900">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        class="w-full border rounded-lg p-2.5"
                    >

                        <option value="">Semua Kategori</option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex items-end">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg"
                    >
                        Tampilkan
                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- Tabel --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">

        <div class="p-6 border-b">
            <h2 class="text-lg font-bold text-green-900">
                Data Stok Barang
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="px-6 py-3 text-green-900">No</th>
                        <th class="px-6 py-3 text-green-900">Nama Produk</th>
                        <th class="px-6 py-3 text-green-900">Kategori</th>
                        <th class="px-6 py-3 text-green-900">SKU</th>
                        <th class="px-6 py-3 text-green-900 text-center">Minimum Stok</th>
                        <th class="px-6 py-3 text-green-900 text-center">Stok</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($stocks as $index => $stock)

                        <tr class="border-b">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $stock->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $stock->category->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $stock->sku }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $stock->minimum_stock }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $stock->stock }}
                            </td>

                            

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center px-6 py-6">
                                Tidak ada data stok.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
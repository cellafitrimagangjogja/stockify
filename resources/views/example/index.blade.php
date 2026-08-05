@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-green-900">
            Dashboard Manager
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Ringkasan informasi stok dan transaksi barang.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

            <p class="text-sm font-medium text-green-900">
                Stok Menipis
            </p>

            <p class="mt-2 text-3xl font-bold text-red-600">
                {{ $stokMenipis->count() }}
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Produk yang perlu diperhatikan
            </p>

        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

            <p class="text-sm font-medium text-green-900">
                Barang Masuk Hari Ini
            </p>

            <p class="mt-2 text-3xl font-bold text-green-600">
                {{ $barangMasukHariIni }}
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Total jumlah barang masuk
            </p>

        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

            <p class="text-sm font-medium text-green-900">
                Barang Keluar Hari Ini
            </p>

            <p class="mt-2 text-3xl font-bold text-blue-600">
                {{ $barangKeluarHariIni }}
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Total jumlah barang keluar
            </p>

        </div>

    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">

        <div class="p-5 border-b border-gray-200">

            <h2 class="text-lg font-bold text-green-900">
                Daftar Stok Menipis
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Daftar produk yang stoknya berada di bawah atau sama dengan batas minimum.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="text-xs text-green-900 uppercase bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-center">
                            No
                        </th>

                        <th class="px-6 py-3">
                            Produk
                        </th>

                        <th class="px-6 py-3 text-center">
                            Stok Saat Ini
                        </th>

                        <th class="px-6 py-3 text-center">
                            Minimum Stok
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($stokMenipis as $product)

                        <tr class="bg-white border-b hover:bg-gray-50">

                            <td class="px-6 py-4 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4 text-center font-semibold text-red-600">
                                {{ $product->stock }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $product->minimum_stock }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-6 py-8 text-center text-gray-500"
                            >
                                Tidak ada produk dengan stok menipis.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
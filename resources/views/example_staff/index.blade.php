@extends('example_staff.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Dashboard Staff Gudang
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Daftar tugas yang harus diselesaikan oleh Staff Gudang.
        </p>

    </div>


    {{-- KARTU TUGAS --}}
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">

        {{-- BARANG MASUK --}}
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

            <p class="text-sm font-medium text-gray-500">
                Barang Masuk
            </p>

            <p class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $barangMasuk->count() }}
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Barang perlu diperiksa
            </p>

        </div>


        {{-- BARANG KELUAR --}}
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

            <p class="text-sm font-medium text-gray-500">
                Barang Keluar
            </p>

            <p class="mt-2 text-3xl font-bold text-blue-600">
                {{ $barangKeluar->count() }}
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Barang perlu disiapkan
            </p>

        </div>

    </div>


    {{-- BARANG MASUK --}}
    <div class="mb-6 overflow-hidden bg-white rounded-lg shadow">

        <div class="p-5 border-b">

            <h2 class="text-lg font-semibold text-gray-900">
                Barang Masuk yang Perlu Diperiksa
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-700 uppercase bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-center">
                            No
                        </th>

                        <th class="px-6 py-3">
                            Produk
                        </th>

                        <th class="px-6 py-3 text-center">
                            Jumlah
                        </th>

                        <th class="px-6 py-3 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($barangMasuk as $transaction)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $transaction->product?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $transaction->quantity }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                    Pending
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">

                                Tidak ada barang masuk yang perlu diperiksa.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- BARANG KELUAR --}}
    <div class="overflow-hidden bg-white rounded-lg shadow">

        <div class="p-5 border-b">

            <h2 class="text-lg font-semibold text-gray-900">
                Barang Keluar yang Perlu Disiapkan
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-700 uppercase bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-center">
                            No
                        </th>

                        <th class="px-6 py-3">
                            Produk
                        </th>

                        <th class="px-6 py-3 text-center">
                            Jumlah
                        </th>

                        <th class="px-6 py-3 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($barangKeluar as $transaction)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $transaction->product?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $transaction->quantity }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                    Pending
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">

                                Tidak ada barang keluar yang perlu disiapkan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
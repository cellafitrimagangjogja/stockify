@extends('example_admin.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-bold text-green-900">
            Riwayat Barang Masuk & Keluar
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Riwayat seluruh transaksi barang masuk dan barang keluar yang telah tercatat.
        </p>

        <div class="mb-4 sm:mb-0">
                    
            <label for="riwayattransaksi-search" class="sr-only">Search</label>
                <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                    <input type="date" name="search" id="riwayattransaksi-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                    
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-green-800">
                Barang Masuk - Pending
            </p>
            <p class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $masukPending }}
            </p>
        </div>


        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-green-800">
                Barang Masuk - Diterima
            </p>
            <p class="mt-2 text-3xl font-bold text-green-600">
                {{ $masukDiterima }}
            </p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-green-800">
                Barang Masuk - Ditolak
            </p>
            <p class="mt-2 text-3xl font-bold text-red-600">
                {{ $masukDitolak }}
            </p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-green-800">
                Barang Keluar - Pending
            </p>
            <p class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $keluarPending }}
            </p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-green-800">
                Barang Keluar - Dikeluarkan
            </p>
            <p class="mt-2 text-3xl font-bold text-blue-600">
                {{ $keluarDikeluarkan }}
            </p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-green-800">
                Barang Keluar - Ditolak
            </p>
            <p class="mt-2 text-3xl font-bold text-red-600">
                {{ $keluarDitolak }}
            </p>
        </div>

    </div>

    <div class="relative overflow-x-auto bg-white shadow-md rounded-lg">

        <table class="w-full text-sm text-left text-gray-500">

            <thead class="text-xs text-green-900 uppercase bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-center">
                        No
                    </th>

                    <th class="px-6 py-3">
                        Produk
                    </th>

                    <th class="px-6 py-3">
                        SKU
                    </th>

                    <th class="px-6 py-3 text-center">
                        Jenis Transaksi
                    </th>

                    <th class="px-6 py-3 text-center">
                        Jumlah
                    </th>

                    <th class="px-6 py-3 text-center">
                        Tanggal
                    </th>

                    <th class="px-6 py-3 text-center">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($transactions as $transaction)

                <tr class="riwayattransaksi-row border-b hover:bg-gray-50" data-date="{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}">

                    {{-- NO --}}
                    <td class="px-6 py-4 text-center">
                        {{ $loop->iteration }}
                    </td>


                    {{-- PRODUK --}}
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $transaction->product->name ?? '-' }}
                    </td>


                    {{-- SKU --}}
                    <td class="px-6 py-4">
                        {{ $transaction->product->sku ?? '-' }}
                    </td>


                    {{-- JENIS TRANSAKSI --}}
                    <td class="px-6 py-4 text-center">

                        @if(strtolower(trim($transaction->type)) === 'masuk')

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-green-800 bg-green-100 rounded-full">
                                Barang Masuk
                            </span>

                        @elseif(strtolower(trim($transaction->type)) === 'keluar')

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-red-800 bg-red-100 rounded-full">
                                Barang Keluar
                            </span>

                        @else

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-gray-800 bg-gray-100 rounded-full">
                                {{ $transaction->type ?? '-' }}
                            </span>

                        @endif

                    </td>


                    {{-- JUMLAH --}}
                    <td class="px-6 py-4 text-center font-semibold">

                        {{ $transaction->quantity }}

                    </td>


                    {{-- TANGGAL --}}
                    <td class="px-6 py-4 text-center">

                        {{ $transaction->date
                            ? \Carbon\Carbon::parse($transaction->date)->format('d-m-Y')
                            : '-' }}

                    </td>


                    {{-- STATUS --}}
                    <td class="px-6 py-4 text-center">

                        @if($transaction->status === 'Pending')

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-yellow-800 bg-yellow-100 rounded-full">
                                Pending
                            </span>

                        @elseif($transaction->status === 'Diterima')

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-green-800 bg-green-100 rounded-full">
                                Diterima
                            </span>

                        @elseif($transaction->status === 'Ditolak')

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-red-800 bg-red-100 rounded-full">
                                Ditolak
                            </span>

                        @elseif($transaction->status === 'Dikeluarkan')

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-blue-800 bg-blue-100 rounded-full">
                                Dikeluarkan
                            </span>

                        @else

                            <span class="inline-flex px-3 py-1 text-xs font-medium
                                         text-gray-800 bg-gray-100 rounded-full">
                                {{ $transaction->status ?? '-' }}
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="px-6 py-8 text-center text-gray-500">

                        Belum ada riwayat transaksi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('riwayattransaksi-search');

    input.addEventListener('change', function () {

        const value = this.value;

        document.querySelectorAll('.riwayattransaksi-row').forEach(function(row){

            if (row.dataset.date === value || value === '') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

});
</script>

@endsection
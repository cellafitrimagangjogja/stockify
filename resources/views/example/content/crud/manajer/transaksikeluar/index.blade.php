@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-2xl font-extrabold text-green-900">
                Transaksi Barang Keluar
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Daftar pengeluaran barang dari gudang.
            </p>

            <div class="mb-4 sm:mb-0">
                    
                <label for="transaksikeluar-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="date" name="search" id="transaksikeluar-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                        
            </div>

        </div>

        <a href="{{ route('transaksi-barangkeluar.create') }}"
           class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">

            + Tambah Barang Keluar

        </a>

    </div>


    @if(session('success'))

        <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    <div class="relative overflow-x-auto bg-white shadow-md rounded-lg">

        <table class="w-full text-sm text-left text-gray-500">

            <thead class="text-xs text-green-900 uppercase bg-gray-100">

                <tr>

                    <th class="px-6 py-3">
                        No
                    </th>

                    <th class="px-6 py-3">
                        Tanggal
                    </th>

                    <th class="px-6 py-3 text-center">
                        Produk
                    </th>

                    <th class="px-6 py-3">
                        SKU
                    </th>

                    <th class="px-6 py-3">
                        Jumlah
                    </th>

                    <th class="px-6 py-3 text-center">
                        Catatan
                    </th>

                    <th class="px-6 py-3 text-center">
                        Status
                    </th>
                    
                    <th class="px-6 py-3 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($transactions as $transaction)

                <tr class="transaksikeluar-row border-b hover:bg-gray-50" data-date="{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}">

                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $transaction->product->name ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $transaction->product->sku ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $transaction->quantity }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $transaction->notes }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center">

                            <span class="
                                px-3 py-1 text-xs font-medium rounded-full

                                @if($transaction->status == 'Pending')
                                    text-yellow-800 bg-yellow-100

                                @elseif($transaction->status == 'Diterima')
                                    text-green-800 bg-green-100

                                @elseif($transaction->status == 'Ditolak')
                                    text-red-800 bg-red-100

                                @elseif($transaction->status == 'Dikeluarkan')
                                    text-blue-800 bg-blue-100

                                @else
                                    text-gray-800 bg-gray-100
                                @endif
                            ">
                                {{ $transaction->status }}
                            </span>

                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">

                        <div class="flex justify-center gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('transaksi-barangkeluar.edit', $transaction->id) }}"
                            class="px-3 py-2 text-xs text-white bg-blue-500 rounded-lg hover:bg-yellow-600">
                                Edit
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('transaksi-barangkeluar.destroy', $transaction->id) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-3 py-2 text-xs text-white bg-red-600 rounded-lg hover:bg-red-700">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="px-6 py-8 text-center">

                        Belum ada transaksi barang keluar.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('transaksikeluar-search');

    input.addEventListener('change', function () {

        const value = this.value;

        document.querySelectorAll('.transaksikeluar-row').forEach(function(row){

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
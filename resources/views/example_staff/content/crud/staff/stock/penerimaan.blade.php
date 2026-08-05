@extends('example_staff.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    {{-- HEADER --}}
    <div class="mb-6 fle items-center justify-between">

        <h1 class="text-2xl font-extrabold text-green-900">
            Konfirmasi Penerimaan Barang
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Periksa dan konfirmasi penerimaan barang yang masuk ke gudang.
        </p>

        <div class="flex items-center mb-4 sm:mb-0">
            
                <label for="penerimaanbarang-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="text" name="search" id="penerimaanbarang-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Cari Data Penerimaan Barang">
                    </div>
            
        </div>

    </div>


    {{-- NOTIFIKASI --}}
    @if(session('success'))

        <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-100">
            {{ session('success') }}
        </div>

    @endif


    {{-- TABEL --}}
    <div class="relative overflow-x-auto bg-white rounded-lg shadow">

        <div class="p-5 border-b">
            <h2 class="text-lg font-bold text-green-900">
                Daftar Penerimaan Barang
            </h2>
        </div>

        <table class="w-full text-sm text-left text-gray-500">

            <thead class="text-xs text-green-900 uppercase bg-gray-100">

                <tr class="penerimaanbarang-row border-b hover:bg-gray-50">

                    <th class="px-6 py-3 text-center">
                        No
                    </th>

                    <th class="px-6 py-3">
                        Produk
                    </th>

                    <th class="px-6 py-3">
                        SKU
                    </th>

                    <th class="px-6 py-3">
                        Jumlah
                    </th>

                    <th class="px-6 py-3">
                        Tanggal
                    </th>

                    <th class="px-6 py-3">
                        Status
                    </th>

                    <th class="px-6 py-3 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($transactions as $transaction)

                    <tr class="bg-white border-b hover:bg-gray-50">

                        <td class="px-6 py-4 text-center">
                            {{ $loop->iteration }}
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
                            {{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4">

                            @if($transaction->status == 'Pending')

                                <span class="px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">
                                    Pending
                                </span>

                            @elseif($transaction->status == 'Diterima')

                                <span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                    Diterima
                                </span>

                            @elseif($transaction->status == 'Ditolak')

                                <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                    Ditolak
                                </span>

                            @else

                                <span class="px-3 py-1 text-xs font-medium text-gray-800 bg-gray-100 rounded-full">
                                    {{ $transaction->status }}
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 text-center">

                            <div class="flex items-center justify-center gap-2">

                                <form
                                    action="{{ route('staff.stok.penerimaan.terima', $transaction->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 text-sm text-white bg-green-500 rounded-lg hover:bg-green-500">

                                        Diterima

                                    </button>

                                </form>

                                <form
                                    action="{{ route('staff.stok.penerimaan.tolak', $transaction->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-500">

                                        Ditolak

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-8 text-center text-gray-500">

                            Belum ada data penerimaan barang.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('penerimaanbarang-search');
    const rows = document.querySelectorAll('.penerimaanbarang-row');

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        rows.forEach(function (row) {

            const rowText = row.textContent.toLowerCase();

            if (keyword === '' || rowText.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

});
</script>

@endsection
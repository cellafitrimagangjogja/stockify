@extends('example_admin.layouts.default.dashboard')

@section('title', 'Laporan Transaksi')

@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-green-900">
            Laporan Transaksi Barang
        </h1>

        <p class="text-gray-500">
            Menampilkan transaksi barang masuk dan keluar.
        </p>
    </div>


    {{-- Filter --}}

    <div class="bg-white rounded-lg shadow p-6 mb-6">

        <form action="{{ route('admin.laporan.transaksi') }}" method="GET">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

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


                <div>
                    <label class="block mb-2 text-sm font-medium text-green-900">
                        Jenis Transaksi
                    </label>

                    <select
                        name="type"
                        class="w-full border rounded-lg p-2.5">

                        <option value="">
                            Semua Transaksi
                        </option>

                        <option
                            value="masuk"
                            {{ request('type') == 'masuk' ? 'selected' : '' }}
                        >
                            Barang Masuk
                        </option>

                        <option
                            value="keluar"
                            {{ request('type') == 'keluar' ? 'selected' : '' }}
                        >
                            Barang Keluar
                        </option>

                    </select>
                </div>


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

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="px-6 py-3 text-green-900">No</th>
                        <th class="px-6 py-3 text-green-900">Tanggal</th>
                        <th class="px-6 py-3 text-green-900">Pengguna</th>
                        <th class="px-6 py-3 text-green-900">Nama Produk</th>
                        <th class="px-6 py-3 text-green-900 text-center">Jenis</th>
                        <th class="px-6 py-3 text-center text-green-900">Jumlah</th>
                        <th class="px-6 py-3 text-center text-green-900">Catatan</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($transactions as $index => $transaction)

                    <tr class="border-b">

                        <td class="px-6 py-4">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $transaction->created_at->format('d-m-Y H:i') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $transaction->user->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $transaction->product->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if(strtolower(trim($transaction->type)) === 'masuk')
                                <span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                    Masuk
                                </span>

                            @elseif(strtolower(trim($transaction->type)) === 'keluar')
                                <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                    Keluar
                                </span>
                            @endif

                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $transaction->quantity }}
                        </td>

                        <td class="px-6 py-4 ">
                            {{ $transaction->notes ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center p-6">
                            Belum ada data transaksi.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
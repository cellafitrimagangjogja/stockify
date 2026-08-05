@extends('example_admin.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-extrabold text-green-900">
            Stock Opname
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Riwayat stock opname yang dilakukan oleh Manajer Gudang.
        </p>

        <div class="mb-4 sm:mb-0">
                    
            <label for="stockopname-search" class="sr-only">Search</label>
                <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                    <input type="date" name="search" id="stockopname-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                    
        </div>

    </div>

    <div class="relative overflow-x-auto bg-white rounded-lg shadow">

        <div class="p-5 border-b">
            <h2 class="text-lg font-semibold text-green-900">
                Riwayat Stock Opname
            </h2>
        </div>

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
                        Stok Sistem
                    </th>

                    <th class="px-6 py-3">
                        Stok Nyata
                    </th>

                    <th class="px-6 py-3">
                        Selisih
                    </th>

                    <th class="px-6 py-3">
                        Tanggal
                    </th>

                    <th class="px-6 py-3">
                        Catatan
                    </th>

                    <th class="px-6 py-3">
                        Pemeriksa
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($stockOpnames as $stockOpname)

                    <tr class="stockopname-row border-b hover:bg-gray-50" data-date="{{ \Carbon\Carbon::parse($stockOpname->opname_date)->format('Y-m-d') }}">

                        <td class="px-6 py-4 text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $stockOpname->product->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stockOpname->system_stock }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stockOpname->physical_stock }}
                        </td>

                        <td class="px-6 py-4">

                            @if($stockOpname->difference > 0)

                                <span class="text-green-600 font-semibold">
                                    +{{ $stockOpname->difference }}
                                </span>

                            @elseif($stockOpname->difference < 0)

                                <span class="text-red-600 font-semibold">
                                    {{ $stockOpname->difference }}
                                </span>

                            @else

                                <span class="text-gray-600 font-semibold">
                                    0
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">
                            {{ $stockOpname->opname_date->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stockOpname->note}}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stockOpname->user->name ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="px-6 py-8 text-center">
                            Belum ada data stock opname.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('stockopname-search');

    input.addEventListener('change', function () {

        const value = this.value;

        document.querySelectorAll('.stockopname-row').forEach(function(row){

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
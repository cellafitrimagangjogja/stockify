@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-extrabold text-green-900">
            Stock Opname
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Periksa dan bandingkan stok fisik dengan stok yang tercatat di sistem.
        </p>

    </div>


    {{-- NOTIFIKASI --}}
    @if(session('success'))

        <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-100">
            {{ session('success') }}
        </div>

    @endif


    {{-- FORM STOCK OPNAME --}}
    <div class="p-6 mb-6 bg-white rounded-lg shadow">

        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Input Stock Opname
        </h2>

        <form action="{{ route('stockopname.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- PRODUK --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Produk
                    </label>

                    <select
                        name="product_id"
                        id="product_id"
                        class="w-full p-2.5 border border-gray-300 rounded-lg"
                        required>

                        <option value="">
                            -- Pilih Produk --
                        </option>

                        @foreach($products as $product)

                            <option
                                value="{{ $product->id }}"
                                data-stock="{{ $product->stock }}">

                                {{ $product->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- STOK SISTEM --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Stok di Sistem
                    </label>

                    <input
                        type="number"
                        id="system_stock"
                        class="w-full p-2.5 bg-gray-100 border border-gray-300 rounded-lg"
                        readonly>

                </div>


                {{-- STOK NYATA --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Stok Nyata
                    </label>

                    <input
                        type="number"
                        name="physical_stock"
                        id="physical_stock"
                        min="0"
                        class="w-full p-2.5 border border-gray-300 rounded-lg"
                        required>

                </div>


                {{-- SELISIH --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Selisih
                    </label>

                    <input
                        type="number"
                        id="difference"
                        class="w-full p-2.5 bg-gray-100 border border-gray-300 rounded-lg"
                        readonly>

                </div>


                {{-- TANGGAL --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="opname_date"
                        value="{{ date('Y-m-d') }}"
                        class="w-full p-2.5 border border-gray-300 rounded-lg"
                        required>

                </div>


                {{-- CATATAN --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Catatan
                    </label>

                    <textarea
                        name="note"
                        rows="1"
                        class="w-full p-2.5 border border-gray-300 rounded-lg"></textarea>

                </div>

            </div>


            <div class="mt-6">

                <button
                    type="submit"
                    class="px-5 py-2.5 text-white bg-blue-600 rounded-lg hover:bg-blue-700">

                    Simpan Stock Opname

                </button>

            </div>

        </form>

    </div>


    {{-- RIWAYAT STOCK OPNAME --}}
    <div class="relative overflow-x-auto bg-white rounded-lg shadow">

        <div class="p-5 border-b">

            <h2 class="text-lg font-bold text-green-900">
                Riwayat Stock Opname
            </h2>
            
             <div class="mb-4 sm:mb-0">
                    
                <label for="stockopname-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="date" name="search" id="stockopname-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                        
            </div>
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

                    <th class="px-6 py-3 text-center">
                        Stok Sistem
                    </th>

                    <th class="px-6 py-3 text-center">
                        Stok Nyata
                    </th>

                    <th class="px-6 py-3 text-center">
                        Selisih
                    </th>

                    <th class="px-6 py-3">
                        Tanggal
                    </th>

                    <th class="px-6 py-3">
                        Catatan
                    </th>

                    <th class="px-6 py-3 text-center">
                        Pengguna
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
                            {{ $stockOpname->product->name }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $stockOpname->system_stock }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $stockOpname->physical_stock }}
                        </td>

                        <td class="px-6 py-4 text-center">

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
                            {{ \Carbon\Carbon::parse($stockOpname->opname_date)->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stockOpname->note ?? '-'}}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $stockOpname->user->name ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-6 py-8 text-center">

                            Belum ada data stock opname.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- HITUNG STOK SISTEM DAN SELISIH --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const productSelect = document.getElementById('product_id');

    const systemStock = document.getElementById('system_stock');

    const actualStock = document.getElementById('physical_stock');

    const difference = document.getElementById('difference');


    function calculateDifference() {

        const system = parseInt(systemStock.value) || 0;

        const actual = parseInt(actualStock.value) || 0;

        difference.value = actual - system;

    }


    productSelect.addEventListener('change', function () {

        const selectedOption =
            this.options[this.selectedIndex];

        const stock =
            selectedOption.getAttribute('data-stock');

        systemStock.value = stock || 0;

        calculateDifference();

    });


    actualStock.addEventListener(
        'input',
        calculateDifference
    );

});

</script>

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
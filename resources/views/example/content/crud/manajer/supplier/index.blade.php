@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 sm:p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-extrabold text-green-900">
            Data Supplier
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Daftar supplier yang terdaftar dalam sistem.
        </p>

        <div class="mb-4 sm:mb-0">
                    
            <label for="supplier-search" class="sr-only">Search</label>
                <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                    <input type="text" name="search" id="supplier-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Cari Data Supplier">
                </div>
                    
        </div>
    </div>

    <div class="relative overflow-x-auto bg-white shadow-md rounded-lg">

        <div class="p-5 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-900">
                Daftar Supplier
            </h2>

        </div>


        <table class="w-full text-sm text-left text-gray-500">

            {{-- HEADER TABEL --}}
            <thead class="text-xs text-green-900 uppercase bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-center">
                        No
                    </th>

                    <th class="px-6 py-3">
                        Nama Supplier
                    </th>

                    <th class="px-6 py-3">
                        Nomor Telepon
                    </th>

                    <th class="px-6 py-3 text-center">
                        Email
                    </th>

                    <th class="px-6 py-3 text-center">
                        Alamat
                    </th>

                </tr>

            </thead>


            {{-- BODY TABEL --}}
            <tbody>

                @forelse($suppliers as $supplier)

                    <tr class="supplier-row border-b hover:bg-gray-50">

                        {{-- NO --}}
                        <td class="px-6 py-4 text-center">
                            {{ $loop->iteration }}
                        </td>


                        {{-- NAMA SUPPLIER --}}
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $supplier->name ?? '-' }}
                        </td>


                        {{-- NOMOR TELEPON --}}
                        <td class="px-6 py-4">
                            {{ $supplier->phone ?? '-' }}
                        </td>


                        {{-- EMAIL --}}
                        <td class="px-6 py-4">
                            {{ $supplier->email ?? '-' }}
                        </td>


                        {{-- ALAMAT --}}
                        <td class="px-6 py-4">
                            {{ $supplier->address ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="px-6 py-8 text-center text-gray-500">

                            Belum ada data supplier.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('supplier-search');
    const rows = document.querySelectorAll('.supplier-row');

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
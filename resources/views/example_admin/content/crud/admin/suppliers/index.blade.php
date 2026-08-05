@extends('example_admin.layouts.default.dashboard')


@section('title', 'suppliers')

@section('content')

<div class="container mx-auto px-6 py-6">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-green-900">Supplier</h1>
            <div class="mb-4 sm:mb-0">
                    
                <label for="supplier-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="text" name="search" id="supplier-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Cari Data Supplier">
                    </div>
                    
            </div>
        </div>
    <div class="flex justify-between items-center mb-5">

        <a href="{{ route('admin.suppliers.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Tambah Supplier
        </a>
    </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-green-900">No</th>
                    <th class="p-3 text-green-900">Nama</th>
                    <th class="p-3 text-green-900">Alamat</th>
                    <th class="p-3 text-green-900">No handphone</th>
                    <th class="p-3 text-green-900">Email</th>
                    <th class="p-3 text-green-900">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($suppliers as $supplier)
                <tr class="supplier-row border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-3">
                        {{ $supplier->name }}
                    </td>

                    <td class="p-3">
                        {{ $supplier->address }}
                    </td>

                    <td class="p-3">
                        {{ $supplier->phone }}
                    </td>

                    <td class="p-3">
                        {{ $supplier->email }}
                    </td>
                    
                    <td class="p-3">
                        <div class="flex gap-2">

                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus supplier?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Delete
                                </button>

                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-5">
                        Belum ada supplier
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



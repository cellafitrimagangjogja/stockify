@extends('example_admin.layouts.default.dashboard')

@section('title', 'Manajemen Produk')

@section('content')

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                
                <h1 class="text-xl font-extrabold text-green-900 sm:text-2xl">All products</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100">
                <div class="flex items-center mb-4 sm:mb-0">
                    
                        <label for="products-search" class="sr-only">Search</label>
                            <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                                <input type="text" name="search" id="products-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Cari Data Produk">
                            </div>
                    
                </div>
                        <div class="flex gap-3">
                <a href="{{ route('admin.products.export') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Export Excel
                </a>
                <button
                    type="button"
                    onclick="window.location='{{ route('admin.products.import') }}'"
                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Import Data Produk
                </button>
                <button
                    type="button"
                    onclick="window.location='{{ route('admin.products.create') }}'"
                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Add New Product
                </button>
                </div>
            </div>
        </div>
    </div>

   @if(session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 rounded bg-red-100 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
    <table class="w-full table-fixed text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                <th class="w-12 px-4 py-3 text-green-900">No</th>
                <th class="w-24 px-4 py-3 text-green-900">Gambar</th>
                <th class="w-40 px-4 py-3 text-green-900">Nama Produk</th>
                <th class="w-24 px-4 py-3 text-green-900">SKU</th>
                <th class="w-32 px-4 py-3 text-green-900">Kategori</th>
                <th class="w-32 px-4 py-3 text-green-900">Supplier</th>
                <th class="w-24 px-4 py-3 text-green-900">Harga Beli</th>
                <th class="w-24 px-4 py-3 text-green-900">Harga Jual</th>
                <th class="w-20 px-4 py-3 text-green-900">Min Stok</th>
                <th class="w-40 px-4 py-3 text-green-900">Deskripsi</th>
                <th class="w-36 px-4 py-3 center text-green-900">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">

                @if($products->count() == 0)

                    <tr>
                        <td colspan="10" class="text-center p-4">
                            Belum ada data produk
                        </td>
                    </tr>

                @else
                @foreach($products as $product)

            <tr class="products-row border-b hover:bg-gray-50">

                <td class="px-4 py-3 text-center">
                    {{ $loop->iteration }}
                </td>


                <td class="px-4 py-3">
                    <img 
                    src="{{ asset('storage/products/'.$product->image) }}"
                    class="w-16 h-16 object-contain rounded-lg border mx-auto">
                </td>

                <td class="px-4 py-3">
                    <div class="truncate" title="{{ $product->name }}">
                        {{ $product->name }}
                    </div>
                </td>

                <td class="px-4 py-3">
                    {{ $product->sku }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->category->name }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->supplier->name }}
                </td>


                <td class="px-4 py-3">
                    Rp {{ number_format($product->purchase_price,0,',','.') }}
                </td>


                <td class="px-4 py-3">
                    Rp {{ number_format($product->selling_price,0,',','.') }}
                </td>


                <td class="px-4 py-3 text-center">
                    {{ $product->minimum_stock }}
                </td>


                <td class="px-4 py-3">
                    <div class="truncate" title="{{ $product->description }}">
                        {{ $product->description }}
                    </div>
                </td>


                <td class="px-6 py-4 text-center w-[150px]">
                    <div class="flex justify-center gap-2">

                        <a href="{{ route('admin.products.edit', $product->id) }}"
                        class="bg-blue-500 text-white px-3 py-2 rounded">
                            Edit
                        </a>


                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-2 rounded"
                                onclick="return confirm('Yakin ingin menghapus data?')">
                                Delete
                            </button>
                        </form>
                        </div>
                    </td>

                </tr>

                @endforeach

               @endif

            </tbody>

        </table>
    </div>

</div>
<!-- Edit Product Drawer -->
<div id="drawer-update-product-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase">Update Product</h5>
    <button type="button" data-drawer-dismiss="drawer-update-product-default" aria-controls="drawer-update-product-default" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form action="#">
        <div class="space-y-4">
            <div>
                <label class="block mb-2 text-xs font-medium">
                    Nama Kategori
                </label>

                <input type="text"
                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
            </div>

            <div>
                <label class="block mb-2 text-xs font-medium">
                    Deskripsi
                </label>

                <textarea rows="4"
                    class="block w-full p-2.5 border rounded-lg"></textarea>
            </div>

        </div>

        <td class="w-36 px-4 py-4 whitespace-nowrap">
            <div class="flex gap-2">
                <a href="#" 
                class="bg-blue-500 text-white px-3 py-2 rounded">
                    Edit
                </a>

                <button 
                class="bg-red-500 text-white px-3 py-2 rounded">
                    Delete
                </button>
            </div>
        </td>
    </form>
</div>


<!-- Delete Product Drawer -->
<div id="drawer-delete-product-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label" class="inline-flex items-center text-sm font-semibold text-gray-500 uppercase">Delete item</h5>
    <button type="button" data-drawer-dismiss="drawer-delete-product-default" aria-controls="drawer-delete-product-default" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close menu</span>
    </button>
    <svg class="w-10 h-10 mt-8 mb-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <h3 class="mb-6 text-lg text-gray-500">Are you sure you want to delete this product?</h3>
    <a href="#" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2">
        Yes, I'm sure
    </a>
    <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center" data-drawer-hide="drawer-delete-product-default">
        No, cancel
    </a>
</div>


<!-- Add Product Drawer -->
<div id="drawer-create-product-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase">New Product</h5>
    <button type="button" data-drawer-dismiss="drawer-create-product-default" aria-controls="drawer-create-product-default" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form action="#">
        <div class="space-y-4">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Kategory</label>
                <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type product name" required="">
            </div>

            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="$2999" required="">
            </div>
            
            
            <div class="bottom-0 left-0 flex justify-center w-full pb-4 space-x-4 md:px-4 md:absolute">
                <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Add product
                </button>
                <button type="button" data-drawer-dismiss="drawer-create-product-default" aria-controls="drawer-create-product-default" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Cancel
                </button>
            </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('products-search');
    const rows = document.querySelectorAll('.products-row');

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

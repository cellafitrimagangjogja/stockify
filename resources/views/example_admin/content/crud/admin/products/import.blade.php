@extends('example_admin.layouts.default.dashboard')

@section('content')

<div class="p-6">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-xl font-semibold text-gray-800 mb-5">
            Import Data Produk
        </h1>

        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form 
            action="{{ route('admin.products.import.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Pilih File Excel
                </label>

                <input 
                    type="file"
                    name="file"
                    accept=".xlsx,.xls,.csv"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">

                <p class="mt-2 text-sm text-gray-500">
                    Format file yang diperbolehkan: XLSX, XLS, CSV
                </p>

            </div>


            <div class="flex gap-3">

                <button
                    type="submit"
                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Upload File
                </button>


                <a href="{{ route('admin.products.index') }}"
                    class="text-gray-900 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Kembali
                </a>

            </div>


        </form>

    </div>

</div>

@endsection
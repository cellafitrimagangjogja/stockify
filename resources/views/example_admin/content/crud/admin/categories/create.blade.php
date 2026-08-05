@extends('example_admin.layouts.default.dashboard')

@section('title', 'Tambah Kategori')

@section('content')

<div class="container mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Kategori
    </h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

                <div class="bg-white rounded-lg shadow p-6">


                    <hr class="my-6">

                    <div class="grid grid-cols-2 gap-8 w-full">

                        <div class="col-span-2">
                            <label>Nama Kategori</label>

                            <input
                                type="text"
                                name="name"
                                class="mt-2 w-full border rounded-lg p-3">
                        </div>

                        <div>

                            <label>Deskripsi</label>

                            <input
                                type="text"
                                name="description"
                                class="mt-2 w-full border rounded-lg p-3">

                        </div>

                        <div class="flex gap-3 mt-8">

                            <button type="submit"
                                    class="h-11 px-6 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                                Simpan

                            </button>

                            <a href="{{ route('admin.categories.index') }}"
                            class="h-11 px-6 bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

                                Kembali

                            </a>

                        </div>

                </div>    
        </form>

</div>

@endsection


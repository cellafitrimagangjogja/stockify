@extends('example_admin.layouts.default.dashboard')

@section('title', 'Pengaturan')

@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-green-900">
            Pengaturan Umum
        </h1>

        <p class="text-gray-500">
            Atur nama dan logo aplikasi.
        </p>
    </div>


    @if(session('success'))

        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">

            <ul>
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
            </ul>

        </div>

    @endif


    <div class="bg-white rounded-lg shadow p-6">

        <form
            action="{{ route('admin.pengaturan.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            {{-- Nama Aplikasi --}}

            <div class="mb-6">

                <label class="block mb-2 font-medium text-green-800">
                    Nama Aplikasi
                </label>

                <input
                    type="text"
                    name="app_name"
                    value="{{ old('app_name', $setting->app_name ?? 'Stockify') }}"
                    class="w-full border rounded-lg p-2.5"
                    placeholder="Masukkan nama aplikasi"
                >

            </div>


            {{-- Logo --}}

            <div class="mb-6">

                <label class="block mb-2 font-medium text-green-800">
                    Logo Aplikasi
                </label>

                @if($setting && $setting->logo)

                    <div class="mb-4">

                        <img
                            src="{{ asset('storage/' . $setting->logo) }}"
                            alt="Logo"
                            class="h-24 w-auto object-contain"
                        >

                    </div>

                @endif


                <input
                    type="file"
                    name="logo"
                    accept="image/png,image/jpeg,image/webp"
                    class="block w-full"
                >

                <p class="text-sm text-gray-500 mt-2">
                    Format: JPG, PNG, atau WEBP. Maksimal 2MB.
                </p>

            </div>


            {{-- Tombol --}}

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg">
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
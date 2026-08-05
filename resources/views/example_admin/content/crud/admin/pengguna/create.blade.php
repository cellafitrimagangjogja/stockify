@extends('example_admin.layouts.default.dashboard')

@section('title', 'Tambah Pengguna')

@section('content')

<div class="container mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Pengguna
    </h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label>Nama</label>
        <input type="text" name="name"
               class="border rounded w-full p-2">
    </div>

    <div class="mb-4">
        <label>Email</label>
        <input type="email" name="email"
               class="border rounded w-full p-2">
    </div>

    <div class="mb-4">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
            Password
        </label>

        <input
            type="password"
            name="password"
            id="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        >

        <p class="mt-1 text-sm text-gray-500">
            Password harus terdiri dari 8 karakter.
        </p>

        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Role</label>

        <select name="role"
                class="border rounded w-full p-2">

            <option value="Admin">Admin</option>
            <option value="Manajer Gudang">Manajer Gudang</option>
            <option value="Staff Gudang">Staff Gudang</option>

        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>

</form>
</div>
@endsection
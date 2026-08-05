@extends('example_admin.layouts.default.dashboard')


@section('title', 'users')

@section('content')

<div class="container mx-auto px-6 py-6">

    <div class="flex justify-between items-center mb-5">
        <div>
        <h1 class="text-2xl font-extrabold text-green-900">Pengguna</h1>

        <div class="mb-4 sm:mb-0">
                    
            <label for="user-search" class="sr-only">Search</label>
                <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                    <input type="text" name="search" id="user-search" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Cari Data Pengguna">
                </div>
                    
        </div>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">
            <thead class="bg-grey-100">
                <tr>
                    <th class="p-3 text-green-900">No</th>
                    <th class="p-3 text-green-900">Nama</th>
                    <th class="p-3 text-green-900">Email</th>
                    <th class="p-3 text-green-900">Password</th>
                    <th class="p-3 text-green-900">Role</th>
                    <th class="p-3 text-green-900">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr class="user-row border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-3">
                        {{ $user->name }}
                    </td>

                    <td class="p-3">
                        {{ $user->email }}
                    </td>

                    <td class="p-3">
                        {{ $user->password }}
                    </td>

                    <td class="p-3">
                        {{ $user->role }}
                    </td>

                    <td class="p-3">
                        <div class="flex gap-2">

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus pengguna?')">

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
                        Belum ada pengguna
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('user-search');
    const rows = document.querySelectorAll('.user-row');

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
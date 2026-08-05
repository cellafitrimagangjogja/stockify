@extends('example_admin.layouts.default.dashboard')

@section('title', 'Laporan Aktivitas Pengguna')

@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-green-900">
            Laporan Aktivitas Pengguna
        </h1>

        <p class="text-gray-500">
            Menampilkan aktivitas pengguna dalam sistem.
        </p>
    </div>


    {{-- Filter --}}

    <div class="bg-white rounded-lg shadow p-6 mb-6">

        <form action="{{ route('admin.laporan.aktivitas') }}" method="GET">

            <div class="flex gap-4">

                <div>
                    <label class="block mb-2 text-sm font-medium text-green-900">
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="border rounded-lg p-2.5"
                    >
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-green-900">
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="border rounded-lg p-2.5"
                    >
                </div>

                <div class="flex items-end">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg">
                        Tampilkan
                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- Tabel Aktivitas --}}

    <div class="bg-white rounded-lg shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="px-6 py-3 text-green-900">No</th>
                        <th class="px-6 py-3 text-green-900">Nama Pengguna</th>
                        <th class="px-6 py-3 text-green-900 text-center">Email</th>
                        <th class="px-6 py-3 text-green-900 text-center">Role</th>
                        <th class="px-6 py-3 text-green-900 text-center">Aktivitas</th>
                        <th class="px-6 py-3 text-green-900 text-center">Tanggal</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($activities as $index => $activity)

                        <tr class="border-b">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->user?->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->user?->email }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->user?->role }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->description }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center px-6 py-6">
                                Tidak ada data aktivitas pengguna.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

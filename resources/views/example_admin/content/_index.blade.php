@extends('example_admin.layouts.default.dashboard')

@section('title', 'Dashboard Admin')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-extrabold text-green-900 mb-6">
        Dashboard Admin
    </h1>


    {{-- ========================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">

        {{-- Jumlah Produk --}}
        <div class="bg-white rounded-lg shadow p-6">

            <p class="text-sm text-green-900">
                Jumlah Produk
            </p>

            <h3 class="text-3xl font-bold text-green-800 mt-2">
                {{ $totalProducts }}
            </h3>

        </div>


        {{-- Barang Masuk --}}
        <div class="bg-white rounded-lg shadow p-6">

            <p class="text-sm text-green-900">
                Transaksi Barang Masuk
            </p>

            <h3 class="text-3xl font-bold text-green-500 mt-2">
                {{ $stockInThisMonth }}
            </h3>

            <p class="text-xs text-green-800 mt-1">
                Bulan {{ now()->translatedFormat('F Y') }}
            </p>

        </div>


        {{-- Barang Keluar --}}
        <div class="bg-white rounded-lg shadow p-6">

            <p class="text-sm text-green-900">
                Transaksi Barang Keluar
            </p>

            <h3 class="text-3xl font-bold text-red-600 mt-2">
                {{ $stockOutThisMonth }}
            </h3>

            <p class="text-xs text-green-800 mt-1">
                Bulan {{ now()->translatedFormat('F Y') }}
            </p>

        </div>

    </div>



    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">


        {{-- AKTIVITAS PENGGUNA --}}
        <div class="bg-white rounded-lg shadow p-6 h-[550px] flex flex-col">

            <h2 class="text-2xl font-bold text-green-900">
                Aktivitas Pengguna Terbaru
            </h2>

            <p class="text-grey-500 mt-1 mb-6">
                Aktivitas transaksi terbaru pengguna.
            </p>

            <div class="flex-1 overflow-y-auto pr-2">

            @forelse($activities as $activity)

                <div class="flex items-start gap-4 py-4">

                    {{-- Foto Profil --}}
                    @if($activity->user && $activity->user->image)
                        <img
                            src="{{ asset('storage/profile/' . $activity->user->image) }}"
                            alt="{{ $activity->user->name }}"
                            class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                    @else
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-600 font-bold">
                                {{ strtoupper(substr($activity->user->name ?? 'U',0,1)) }}
                            </span>
                        </div>
                    @endif

                    {{-- Informasi --}}
                    <div class="flex-1">

                        {{-- Nama --}}
                        <h3 class="font-semibold text-green-900">
                            {{ $activity->user->name }}
                        </h3>

                        {{-- Role --}}
                        <p class="text-sm text-gray-500">
                            {{ $activity->user->role }}
                        </p>

                        {{-- Aktivitas --}}
                        <p class="mt-1 text-gray-700">
                            {{ $activity->description }}
                        </p>

                        {{-- Waktu --}}
                        <p class="mt-1 text-sm text-gray-400">
                            {{ $activity->created_at->diffForHumans() }}
                        </p>

                    </div>

                </div>

            @empty

                <div class="py-8 text-center text-gray-500">

                    Belum ada aktivitas transaksi.

                </div>

            @endforelse

            </div>
        </div>


        {{-- GRAFIK TRANSAKSI --}}
        <div class="bg-white rounded-lg shadow p-6 h-[550px] flex flex-col">

            <h2 class="text-xl font-bold text-green-900">
                Jumlah Transaksi per Bulan
            </h2>

            <p class="text-sm text-grey-500 mt-1">
                Data transaksi barang masuk dan keluar
                selama tahun {{ now()->year }}.
            </p>

            <div id="transaction-monthly-chart"
                 class="mt-5">
            </div>

        </div>

    </div>


    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-bold text-green-900">
            Grafik Stok Barang
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Kondisi stok produk berdasarkan batas minimum stok.
        </p>

        <div id="stock-status-chart"
             class="mt-5">
        </div>

    </div>

</div>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
        | GRAFIK TRANSAKSI
        
        */

        const transactionElement =
            document.querySelector(
                '#transaction-monthly-chart'
            );


        if (transactionElement) {

            const transactionOptions = {

                series: [

                    {
                        name: 'Barang Masuk',
                        data: @json($monthlyStockIn)
                    },

                    {
                        name: 'Barang Keluar',
                        data: @json($monthlyStockOut)
                    }

                ],

                chart: {

                    type: 'line',

                    height: 350,

                    toolbar: {
                        show: false
                    }

                },

                stroke: {

                    curve: 'smooth',

                    width: 3

                },

                xaxis: {

                    categories:
                        @json($monthLabels),

                    title: {

                        text: 'Bulan'

                    }

                },

                yaxis: {

                    min: 0,

                    title: {

                        text: 'Jumlah Transaksi'

                    }

                },

                legend: {

                    position: 'bottom'

                }

            };


            const transactionChart =
                new ApexCharts(

                    transactionElement,

                    transactionOptions

                );


            transactionChart.render();

        }


        /*
        |--------------------------------------------------------------------------
        | GRAFIK STOK
        |--------------------------------------------------------------------------
        */

        const stockElement =
            document.querySelector(
                '#stock-status-chart'
            );


        if (stockElement) {

            const stockOptions = {

                series: @json($products->pluck('stock')),

                labels: @json($products->pluck('name')),

                chart: {

                    type: 'donut',

                    height: 350

                },

                legend: {

                    position: 'bottom'

                },

                dataLabels: {

                    enabled: true

                }

            };


            const stockChart =
                new ApexCharts(

                    stockElement,

                    stockOptions

                );


            stockChart.render();

        }

    }

);

</script>

@endsection
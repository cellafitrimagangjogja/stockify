<?php

namespace App\Services\Services_admin;

use App\Models\Product;
use App\Models\StockTransaction;
use Carbon\Carbon;
use App\Models\ActivityLog;

class DashboardAdminService
{
    /**
     * Mengambil seluruh data yang dibutuhkan
     * untuk Dashboard Admin.
     */
    public function getDashboardData(): array
    {
        $year = Carbon::now()->year;

        /*
        |--------------------------------------------------------------------------
        | 1. JUMLAH PRODUK
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();


        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $stockInThisMonth = StockTransaction::where('type', 'masuk')
            ->whereBetween('created_at', [
                $startOfMonth,
                $endOfMonth
            ])
            ->count();

        $stockOutThisMonth = StockTransaction::where('type', 'keluar')
            ->whereBetween('created_at', [
                $startOfMonth,
                $endOfMonth
            ])
            ->count();

        $monthlyStockIn = [];

        $monthlyStockOut = [];

        $monthLabels = [];


        for ($month = 1; $month <= 12; $month++) {

            $monthLabels[] = Carbon::create()
                ->month($month)
                ->translatedFormat('M');

            $monthlyStockIn[] = StockTransaction::where('type', 'masuk')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Jumlah transaksi barang keluar
            |--------------------------------------------------------------------------
            */

            $monthlyStockOut[] = StockTransaction::where('type', 'keluar')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        }


        //grafik stock barang

        // grafik stock barang

        // Grafik stok berdasarkan produk

        $products = Product::select('name', 'stock')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | 6. AKTIVITAS PENGGUNA TERBARU
        |--------------------------------------------------------------------------
        |
        | Karena project belum menggunakan ActivityLog,
        | aktivitas diambil dari transaksi stok terbaru.
        |
        */

        $activities = ActivityLog::with('user')
            ->whereHas('user', function ($query) {
                $query->whereIn('role', [
                    'Manajer Gudang',
                    'Staff Gudang',
                ]);
            })
            ->whereBetween('created_at', [
                Carbon::now()->subDays(6)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->latest()
            ->paginate(5);


        /*
        |--------------------------------------------------------------------------
        | 7. RETURN SEMUA DATA DASHBOARD
        |--------------------------------------------------------------------------
        */
        
        return [

            // Jumlah produk
            'totalProducts' => $totalProducts,

            // Statistik transaksi bulan ini
            'stockInThisMonth' => $stockInThisMonth,
            'stockOutThisMonth' => $stockOutThisMonth,

            // Grafik transaksi per bulan
            'monthlyStockIn' => $monthlyStockIn,
            'monthlyStockOut' => $monthlyStockOut,
            'monthLabels' => $monthLabels,

            // Grafik stok
            'products' => $products,

            // Aktivitas pengguna
            'activities' => $activities,
        ];
    }
}
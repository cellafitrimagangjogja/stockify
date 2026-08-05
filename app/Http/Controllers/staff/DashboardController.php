<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\StockTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Barang masuk yang perlu diperiksa
        $barangMasuk = StockTransaction::with('product')
            ->where('type', 'Masuk')
            ->where('status', 'Pending')
            ->latest('created_at')
            ->get();

        // Barang keluar yang perlu disiapkan
        $barangKeluar = StockTransaction::with('product')
            ->where('type', 'Keluar')
            ->where('status', 'Pending')
            ->latest('created_at')
            ->get();

        return view(
            'example_staff.index',
            compact(
                'barangMasuk',
                'barangKeluar'
            )
        );
    }
}
<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Models\Product;
use App\Models\StockTransaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $data = $this->dashboardService->getDashboardData();

        $stokMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->get();

        $barangMasukHariIni = StockTransaction::where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->whereDate('date', Carbon::today())
            ->sum('quantity');

        $barangKeluarHariIni = StockTransaction::where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->whereDate('date', Carbon::today())
            ->sum('quantity');

        return view('example.index', compact(
            'stokMenipis',
            'barangMasukHariIni',
            'barangKeluarHariIni'
        ));
       
    }
}
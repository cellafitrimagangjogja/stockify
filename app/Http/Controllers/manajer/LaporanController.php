<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use App\Services\manajer\LaporanService;
use App\Models\Category;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $laporanService;

    public function __construct(
        LaporanService $laporanService
    ) {
        $this->laporanService = $laporanService;
    }
    public function stokBarang(Request $request)
    
    {
        $stocks = $this->laporanService->getLaporanStok(
            $request->start_date,
            $request->end_date,
            $request->category_id
        );

        $categories = Category::all();

        return view(
            'example.content.crud.manajer.laporan.stok',
            compact(
                'stocks',
                'categories'
            )
        );
    }


    /**
     * Laporan transaksi
     */
    public function barangMasukKeluar(Request $request)
    {
        $transactions = $this->laporanService
            ->getLaporanTransaksi(
                $request->start_date,
                $request->end_date,
                $request->type
            );

        return view(
            'example.content.crud.manajer.laporan.transaksi',
            compact('transactions')
        );
    }

}
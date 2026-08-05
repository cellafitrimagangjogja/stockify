<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Services_admin\LaporanService;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
class LaporanAdminController extends Controller
{
    protected $laporanService;

    public function __construct(
        LaporanService $laporanService
    ) {
        $this->laporanService = $laporanService;
    }


    /**
     * Laporan stok
     */
    public function stok(Request $request)
    {
        $stocks = $this->laporanService->getLaporanStok(
            $request->start_date,
            $request->end_date,
            $request->category_id
        );

        $categories = Category::all();

        return view(
            'example_admin.content.crud.admin.laporan.stok',
            compact(
                'stocks',
                'categories'
            )
        );
    }


    /**
     * Laporan transaksi
     */
    public function transaksi(Request $request)
    {
        $transactions = $this->laporanService
            ->getLaporanTransaksi(
                $request->start_date,
                $request->end_date,
                $request->type
            );

        return view(
            'example_admin.content.crud.admin.laporan.transaksi',
            compact('transactions')
        );
    }


    /**
     * Laporan aktivitas
     */
    public function aktivitas(Request $request)
    {
        $activities = $this->laporanService->getLaporanAktivitas(
            $request->start_date,
            $request->end_date
        );

        return view(
            'example_admin.content.crud.admin.laporan.aktivitas',
            compact('activities')
        );
    }
}
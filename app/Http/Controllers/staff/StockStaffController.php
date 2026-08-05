<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Services\staff\StockStaffService;
use Exception;

class StockStaffController extends Controller
{
    protected $stockStaffService;

    public function __construct(
        StockStaffService $stockStaffService
    ) {
        $this->stockStaffService = $stockStaffService;
    }

    /**
     * Halaman Konfirmasi Penerimaan
     */
    public function penerimaan()
    {
        $transactions =
            $this->stockStaffService->getPenerimaan();

        return view(
            'example_staff.content.crud.staff.stock.penerimaan',
            compact('transactions')
        );
    }

    /**
     * Diterima
     */
    public function terima($id)
    {
          
        try {

            $this->stockStaffService->terimaBarang($id);

            return redirect()
            ->route('staff.stok.penerimaan.index')
            ->with(
                'success',
                'Barang berhasil diterima.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Ditolak
     */
    public function tolakMasuk($id)
    {
        try {

            $this->stockStaffService
                ->tolakBarangMasuk($id);

            return back()->with(
                'success',
                'Penerimaan barang berhasil ditolak.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }


    /**
     * Halaman Konfirmasi Pengeluaran
     */
    public function pengeluaran()
    {
        $transactions =
            $this->stockStaffService->getPengeluaran();

        return view(
            'example_staff.content.crud.staff.stock.pengeluaran',
            compact('transactions')
        );
    }

    /**
     * Dikeluarkan
     */
    public function keluarkan($id)
    {
        try {

            $this->stockStaffService->keluarkanBarang($id);

            return redirect()
            ->route('staff.stok.pengeluaran.index')
            ->with(
                'success',
                'Barang berhasil dikeluarkan.'
            );


        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Ditolak
     */
    public function tolakKeluar($id)
    {
        try {

            $this->stockStaffService
                ->tolakBarangKeluar($id);

            return back()->with(
                'success',
                'Pengeluaran barang berhasil ditolak.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}
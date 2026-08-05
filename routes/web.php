<?php

use App\Http\Controllers\admin\ProfileAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\admin\CategoryAdminController;
use App\Http\Controllers\admin\SupplierAdminController;
use App\Http\Controllers\manajer\ProductController;
use App\Http\Controllers\manajer\ProfileController;
use App\Http\Controllers\admin\StockTransactionAdminController;
use App\Http\Controllers\admin\PenggunaAdminController;
use App\Http\Controllers\admin\LaporanAdminController;
use App\Http\Controllers\admin\PengaturanAdminController;
use App\Http\Controllers\manajer\StockOpnameManagerController;
use App\Http\Controllers\manajer\TransaksiBarangMasukController;
use App\Http\Controllers\manajer\TransaksiBarangKeluarController;
use App\Http\Controllers\Manajer\SupplierController;
use App\Http\Controllers\Manajer\LaporanController;
use App\Http\Controllers\Staff\StockStaffController;
use App\Models\StockTransaction;
use App\Http\Controllers\manajer\DashboardController;
use App\Http\Controllers\Manajer\ProfileManajerController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\staff\ProfileStaffController;

/*ssk 
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/', function(){
        return view('example.content.authentication.sign-in');
    })->middleware('guest')->name('sign-in');
    
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

});

/*
|--------------------------------------------------------------------------
| Auth Routes (Semua User Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Manajer Gudang
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Manajer Gudang']) ->group(function () {

    // Dashboard Manager
    Route::get('/dashboard/manager',[DashboardController::class, 'index' ])
        ->name('dashboard.manager');

    // Produk (Khusus Manager)
    Route::get('/products', [ProductController::class, 'index'])
        ->name('manajer.products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('manajer.products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('manajer.products.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('manajer.products.edit');

    Route::put('/products/{id}', [ProductController::class, 'update'])
        ->name('manajer.products.update');

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('manajer.products.destroy');


    Route::get('/transaksi-barangmasuk', [TransaksiBarangMasukController::class, 'index'])
        ->name('transaksi-barangmasuk.index');

    Route::get('/transaksi-barangmasuk/create', [TransaksiBarangMasukController::class, 'create'])
        ->name('transaksi-barangmasuk.create');

    Route::post('/transaksi-barangmasuk', [TransaksiBarangMasukController::class, 'store'])
        ->name('transaksi-barangmasuk.store');
    
    Route::get('/transaksi-barangmasuk/{id}/edit',[TransaksiBarangMasukController::class, 'edit'])
        ->name('transaksi-barangmasuk.edit');

    Route::put('/transaksi-barangmasuk/{id}',[TransaksiBarangMasukController::class, 'update'])
        ->name('transaksi-barangmasuk.update');

    Route::delete('/transaksi-barangmasuk/{id}', [TransaksiBarangMasukController::class, 'destroy'])
        ->name('transaksi-barangmasuk.destroy');

    Route::get('/transaksi-barangmasuk/{transaksibarangmasuk}', [TransaksiBarangMasukController::class, 'show'])
        ->name('transaksi-barangmasuk.show');


    // ================================
    // TRANSAKSI BARANG KELUAR
    // ================================

    Route::get('/transaksi-barangkeluar', [TransaksiBarangKeluarController::class, 'index'])
        ->name('transaksi-barangkeluar.index');

    Route::get('/transaksi-barangkeluar/create', [TransaksiBarangKeluarController::class, 'create'])
        ->name('transaksi-barangkeluar.create');

    Route::post('/transaksi-barangkeluar', [TransaksiBarangKeluarController::class, 'store'])
        ->name('transaksi-barangkeluar.store');

    Route::get('/transaksi-barangkeluar/{id}/edit',[TransaksiBarangKeluarController::class, 'edit'])
        ->name('transaksi-barangkeluar.edit');

    Route::put('/transaksi-barangkeluar/{id}',[TransaksiBarangKeluarController::class, 'update'])
        ->name('transaksi-barangkeluar.update');

    Route::delete('/transaksi-barangkeluar/{id}', [TransaksiBarangKeluarController::class, 'destroy'])
        ->name('transaksi-barangkeluar.destroy');

    Route::get('/transaksi-barangkeluar/{transaksibarangkeluar}', [TransaksiBarangKeluarController::class, 'show'])
        ->name('transaksi-barangkeluar.show');


    // ================================
    // STOCK OPNAME
    // ================================
    Route::get('/stockopname',[StockOpnameManagerController::class, 'index'])
        ->name('stockopname.index');

    Route::get('/stockopname/create', [StockOpnameManagerController::class, 'create'])
        ->name('stockopname.create');

    Route::post('/stockopname', [StockOpnameManagerController::class, 'store'])
        ->name('stockopname.store');

    Route::get('/stockopname/{stockopname}', [StockOpnameManagerController::class, 'show'])
        ->name('stockopname.show');

    Route::get('/stockopname/{stockopname}/edit', [StockOpnameManagerController::class, 'edit'])
        ->name('stockopname.edit');

    Route::put('/stockopname/{stockopname}', [StockOpnameManagerController::class, 'update'])
        ->name('stockopname.update');

    Route::delete('/stockopname/{stockopname}', [StockOpnameManagerController::class, 'destroy'])
        ->name('stockopname.destroy');

    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('manajer.suppliers.index');

    
    Route::get('/laporan/stok-barang', [LaporanController::class, 'stokBarang'])
        ->name('manajer.laporan.stok-barang');

    Route::get('/laporan/barang-masuk-keluar',  [LaporanController::class, 'barangMasukKeluar'])
        ->name('manajer.laporan.barang-masuk-keluar');

    Route::get('/profilemanajer', [ProfileManajerController::class, 'edit'])
        ->name('profilemanajer.edit');

    Route::patch('/profilemanajer', [ProfileManajerController::class, 'update'])
        ->name('profilemanajer.update');


});


/*
|--------------------------------------------------------------------------
| Admin Gudang
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardAdminController::class,'index'])
        ->name('dashboard.admin');

        Route::get('/products', [ProductAdminController::class, 'index'])
            ->name('admin.products.index');

        Route::get('/products/create', [ProductAdminController::class, 'create'])
            ->name('admin.products.create');

        Route::post('/products', [ProductAdminController::class, 'store'])
            ->name('admin.products.store');

        Route::get('/products/{id}/edit', [ProductAdminController::class, 'edit'])
            ->name('admin.products.edit');

        Route::put('/products/{id}', [ProductAdminController::class, 'update'])
            ->name('admin.products.update');

        Route::delete('/products/{id}', [ProductAdminController::class, 'destroy'])
            ->name('admin.products.destroy');

        Route::get('/admin/products/export',[ProductAdminController::class,'export'])
            ->name('admin.products.export');
        
        Route::get('/admin/products/import',[ProductAdminController::class,'import'])
            ->name('admin.products.import');

        Route::post('/products/import', [ProductAdminController::class, 'importStore'])
            ->name('admin.products.import.store');

        Route::get('/categories', [CategoryAdminController::class, 'index'])
            ->name('admin.categories.index');

        Route::get('/categories/create', [CategoryAdminController::class, 'create'])
            ->name('admin.categories.create');

        Route::post('/categories', [CategoryAdminController::class, 'store'])
            ->name('admin.categories.store');

        Route::get('/categories/{id}/edit', [CategoryAdminController::class, 'edit'])
            ->name('admin.categories.edit');

        Route::put('/categories/{id}', [CategoryAdminController::class, 'update'])
            ->name('admin.categories.update');

        Route::delete('/categories/{id}', [CategoryAdminController::class, 'destroy'])
            ->name('admin.categories.destroy');


        Route::get('/suppliers', [SupplierAdminController::class, 'index'])
            ->name('admin.suppliers.index');

        Route::get('/suppliers/create', [SupplierAdminController::class, 'create'])
            ->name('admin.suppliers.create');

        Route::post('/suppliers', [SupplierAdminController::class, 'store'])
            ->name('admin.suppliers.store');

        Route::get('/suppliers/{id}/edit', [SupplierAdminController::class, 'edit'])
            ->name('admin.suppliers.edit');

        Route::put('/suppliers/{id}', [SupplierAdminController::class, 'update'])
            ->name('admin.suppliers.update');

        Route::delete('/suppliers/{id}', [SupplierAdminController::class, 'destroy'])
            ->name('admin.suppliers.destroy');


        Route::get('/users', [PenggunaAdminController::class, 'index'])
            ->name('admin.users.index');

        Route::get('/users/create', [PenggunaAdminController::class, 'create'])
            ->name('admin.users.create');

        Route::post('/users', [PenggunaAdminController::class, 'store'])
            ->name('admin.users.store');

        Route::get('/users/{id}/edit', [PenggunaAdminController::class, 'edit'])
            ->name('admin.users.edit');

        Route::put('/users/{id}', [PenggunaAdminController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('/users/{id}', [PenggunaAdminController::class, 'destroy'])
            ->name('admin.users.destroy');

        Route::get('/stock-transactions', [StockTransactionAdminController::class, 'index'])
            ->name('stock-transactions.index');

        Route::get('/stock-transactions/create', [StockTransactionAdminController::class, 'create'])
            ->name('stock-transactions.create');

        Route::post('/stock-transactions', [StockTransactionAdminController::class, 'store'])
            ->name('stock-transactions.store');

        Route::get('/stock-transactions/{stockTransaction}', [StockTransactionAdminController::class, 'show'])
            ->name('stock-transactions.show');

        Route::get('/stock-opname', [StockTransactionAdminController::class, 'stockOpname'])
            ->name('admin.stockopname.index');

        Route::get('/stock-riwayattransaksi',action: [StockTransactionAdminController::class, 'riwayat'])
            ->name('admin.riwayat-transaksi.index');

        Route::get('/laporan/stok', [LaporanAdminController::class, 'stok'])
            ->name('admin.laporan.stok');

        Route::get('/laporan/transaksi', [LaporanAdminController::class, 'transaksi'])
            ->name('admin.laporan.transaksi');

        Route::get('/laporan/aktivitas', [LaporanAdminController::class, 'aktivitas'])
            ->name('admin.laporan.aktivitas');

        Route::get('/pengaturan', [PengaturanAdminController::class, 'index'])
            ->name('admin.pengaturan.index');


        Route::put('/pengaturan', [PengaturanAdminController::class, 'update'])
            ->name('admin.pengaturan.update');

        Route::get('/profile', [ProfileAdminController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileAdminController::class, 'update'])
            ->name('profile.update');

        Route::put('/password', [ProfileAdminController::class, 'updatePassword'])
            ->name('password.update');

        
      });



/*
|--------------------------------------------------------------------------
| Staff Gudang
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Staff Gudang'])->group(function () {

    Route::get('/dashboard/staff', function () {

        $barangMasuk = StockTransaction::with('product')
            ->where('type', 'Masuk')
            ->where('status', 'Pending')
            ->latest('created_at')
            ->get();

        $barangKeluar = StockTransaction::with('product')
            ->where('type', 'Keluar')
            ->where('status', 'Pending')
            ->latest('created_at')
            ->get();

        return view('example_staff.index', [
            'title' => 'Dashboard Staff',
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
        ]);

    })->name('dashboard.staff');

    // KONFIRMASI PENERIMAAN
        Route::get('/stok/penerimaan',[StockStaffController::class, 'penerimaan'])
            ->name('staff.stok.penerimaan.index');

        Route::patch('/stok/penerimaan/{id}/terima',[StockStaffController::class, 'terima'])
            ->name('staff.stok.penerimaan.terima');

        Route::patch('/stok/penerimaan/{id}/tolak',[StockStaffController::class, 'tolakMasuk'])
            ->name('staff.stok.penerimaan.tolak');

        // KONFIRMASI PENGELUARAN
        Route::get('/stok/pengeluaran',[StockStaffController::class, 'pengeluaran'])
            ->name('staff.stok.pengeluaran.index');

        Route::patch('/stok/pengeluaran/{id}/keluarkan',[StockStaffController::class, 'keluarkan'])
        ->name('staff.stok.pengeluaran.keluarkan');

        Route::patch('/stok/pengeluaran/{id}/tolak',[StockStaffController::class, 'tolakKeluar'])
        ->name('staff.stok.pengeluaran.tolak');

        Route::get('/profilestaff', [ProfileStaffController::class, 'edit'])
            ->name('profilestaff.edit');

        Route::patch('/profilestaff', [ProfileStaffController::class, 'update'])
            ->name('profilestaff.update');
});

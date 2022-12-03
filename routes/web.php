<?php

use App\Http\Controllers\AddonsController;
use App\Http\Controllers\AlamatUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukAddonsController;
use App\Http\Controllers\ProdukJualController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiDeliveredController;
use App\Http\Controllers\TransaksiPickupController;
use App\Http\Controllers\TransaksiReservasiController;
use App\Http\Controllers\VoucherUserController;
use App\Http\Controllers\Admin;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Api\NotifikasiController as ApiNotifikasiController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverViewController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\NotifikasiEkternalController;
use App\Http\Controllers\PrivasiController;
use App\Http\Controllers\WebView\InvoiceController as WebViewInvoiceController;
use App\Http\Controllers\WebViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'view';
    return view('welcome');
});
Route::get('/resetPass', [LoginController::class, 'ResetPass'])->name('password.reset');
Route::post('/resetPass', [LoginController::class, 'postResetPass'])->name('post.password.reset');
Route::get('/resetPass/sukses', [LoginController::class, 'success'])->name('success.password.reset');
Route::get('/verification/verify', [LoginController::class, 'verification'])->name('verification.verify');
Route::get('/verification/verify/success', [LoginController::class, 'succesVerification'])->name('success.verification.verify');
// Route::get('/Notifikasi/eksternal', [ApiNotifikasiController::class, 'notifikasi'])->name('notifikasi');



Route::prefix('driver_view')->middleware('auth:driver')->group(function(){
    Route::get('/', [DriverViewController::class, 'DriverView'])->name('index_view');
    Route::get('/driver_antar', [DriverViewController::class, 'driver_antar'])->name('driver_antar');
});

Route::prefix('admin')->group(function(){
    Route::get('/login',[LoginController::class,'loginForm'])->name('admin.login')->middleware('guest');
    Route::post('/login',[LoginController::class,'postLogin'])->name('post.admin.login')->middleware('guest');


});
// Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/aktivasi', [AuthController::class, 'aktivasi'])->name('aktivasi');

Route::prefix('dashboard')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

});

Route::prefix('webview')->group(function(){
    Route::get('/invoice/batal', [WebViewInvoiceController::class, 'postBatalUser']) ->name('webview.invoice.batal.user');
    Route::get('/invoice/{id}',[WebViewInvoiceController::class,'index_invoice'])->name('webview.invoice.detail');
    Route::get('/faq',[WebViewInvoiceController::class,'index_faq'])->name('webview.faq');

});

Route::get('/privasi', [PrivasiController::class,'privasi'])->name('privasi');

Route::middleware('auth:admin')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('kategori')->group(function(){
        Route::get('/', [KategoriController::class, 'index']) ->name('kategori');
        Route::get('/tambah', [KategoriController::class, 'tambah']) ->name('kategori.tambah');
        Route::post('/tambah', [KategoriController::class, 'postTambah']) ->name('post.kategori.tambah');
        Route::get('/edit/{id}', [KategoriController::class, 'edit']) ->name('kategori.edit');
        Route::post('/edit', [KategoriController::class, 'postEdit']) ->name('post.kategori.edit');
    });
    
    Route::prefix('produk')->group(function(){
        Route::get('/', [ProdukJualController::class, 'index']) ->name('produk');
        Route::get('/tambah', [ProdukJualController::class, 'tambah']) ->name('produk.tambah');
        Route::get('/addons', [ProdukJualController::class, 'addons']) ->name('produk.addons');
        Route::post('/addons', [ProdukJualController::class, 'postAddons']) ->name('post.produk.addons');
        Route::post('/addons/edit', [ProdukJualController::class, 'postAddonsEdit']) ->name('post.produk.addons.edit');
        Route::get('/addons/hapus', [ProdukJualController::class, 'addonsHapus']) ->name('produk.addons.hapus');
        Route::get('/foto', [ProdukJualController::class, 'foto']) ->name('produk.foto');
        Route::post('/foto/tambah', [ProdukJualController::class, 'postFotoTambah']) ->name('post.produk.foto.tambah');
        Route::post('/foto/hapus', [ProdukJualController::class, 'postFotoHapus']) ->name('post.produk.foto.hapus');
        Route::post('/tambah', [ProdukJualController::class, 'postTambah']) ->name('post.produk.tambah');
        Route::get('/edit/{id}', [ProdukJualController::class, 'edit']) ->name('produk.edit');
        Route::post('/edit', [ProdukJualController::class, 'postEdit']) ->name('post.produk.edit');
        Route::get('/collaps', [ProdukJualController::class, 'postCollaps']) ->name('post.collaps.edit');
    });
    
    Route::prefix('voucher')->group(function(){
        Route::get('/', [VoucherController::class, 'index']) ->name('voucher');
        Route::get('/tambah', [VoucherController::class, 'tambah']) ->name('voucher.tambah');
        Route::post('/tambah', [VoucherController::class, 'postTambah']) ->name('post.voucher.tambah');
        Route::get('/edit/{id}', [VoucherController::class, 'edit']) ->name('voucher.edit');
        Route::post('/edit', [VoucherController::class, 'postEdit']) ->name('post.voucher.edit');
        Route::get('/produk', [VoucherController::class, 'produk']) ->name('selectProduk.tambah');

    });
    Route::prefix('voucher_user')->group(function(){
        Route::get('/', [VoucherUserController::class, 'index']) ->name('voucher_user');
        Route::get('/tambah', [VoucherUserController::class, 'tambah']) ->name('voucher_user.tambah');
        Route::post('/tambah', [VoucherUserController::class, 'postTambah']) ->name('post.voucher_user.tambah');
        Route::get('/edit/{voucher_user_id}', [VoucherUserController::class, 'edit']) ->name('voucher_user.edit');
        Route::post('/edit', [VoucherUserController::class, 'postEdit']) ->name('post.voucher_user.edit');
        Route::get('/voucher/hapus', [VoucherUserController::class, 'voucherHapus']) ->name('voucher_user.hapus');
    });
    Route::prefix('produkaddons')->group(function(){
        Route::get('/', [ProdukAddonsController::class, 'index']) ->name('produkaddons');
        Route::get('/tambah', [ProdukAddonsController::class, 'tambah']) ->name('produkaddons.tambah');
        Route::post('/tambah', [ProdukAddonsController::class, 'postTambah']) ->name('post.produkaddons.tambah');
        Route::get('/edit/{id}', [ProdukAddonsController::class, 'edit']) ->name('produkaddons.edit');
        Route::post('/edit', [ProdukAddonsController::class, 'postEdit']) ->name('post.produkaddons.edit');
    });
    Route::prefix('addons')->group(function(){
        Route::get('/', [AddonsController::class, 'index']) ->name('addons');
        Route::get('/tambah', [AddonsController::class, 'tambah']) ->name('addons.tambah');
        Route::post('/tambah', [AddonsController::class, 'postTambah']) ->name('post.addons.tambah');
        Route::get('/edit/{id}', [AddonsController::class, 'edit']) ->name('addons.edit');
        Route::post('/edit', [AddonsController::class, 'postEdit']) ->name('post.addons.edit');
    });
    Route::prefix('stamp')->group(function(){
        Route::get('/stamp', [StampController::class, 'index']) ->name('stamp');
        Route::get('/tambah', [StampController::class, 'tambah']) ->name('stamp.tambah');
        Route::post('/tambah', [StampController::class, 'postTambah']) ->name('post.stamp.tambah');
        Route::get('/edit/{id}', [StampController::class, 'edit']) ->name('stamp.edit');
        Route::post('/edit', [StampController::class, 'postEdit']) ->name('post.stamp.edit');
    });
    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'index']) ->name('profile');
        Route::get('/tambah', [ProfileController::class, 'tambah']) ->name('profile.tambah');
        Route::post('/tambah', [ProfileController::class, 'postTambah']) ->name('post.profile.tambah');
        Route::get('/edit/{id}', [ProfileController::class, 'edit']) ->name('profile.edit');
        Route::post('/edit', [ProfileController::class, 'postEdit']) ->name('post.profile.edit');
    });
    Route::prefix('alamat_user')->group(function(){
        Route::get('/alamat_user', [AlamatUserController::class, 'index']) ->name('alamat_user');
        Route::get('/tambah', [AlamatUserController::class, 'tambah']) ->name('alamat_user.tambah');
        Route::post('/tambah', [AlamatUserController::class, 'postTambah']) ->name('post.alamat_user.tambah');
        Route::get('/edit/{id}', [AlamatUserController::class, 'edit']) ->name('alamat_user.edit');
        Route::post('/edit', [AlamatUserController::class, 'postEdit']) ->name('post.alamat_user.edit');
    });

    Route::get('/invoice/detail/{id}', [InvoiceController::class, 'detail'])->name('invoice.detail');

    Route::prefix('transaksi_delivered')->group(function(){
        Route::get('/', [TransaksiDeliveredController::class, 'index']) ->name('transaksi_delivered');
        Route::get('/tambah', [TransaksiDeliveredController::class, 'tambah']) ->name('transaksi_delivered.tambah');
        Route::post('/tambah', [TransaksiDeliveredController::class, 'postTambah']) ->name('post.transaksi_delivered.tambah');
        Route::get('/edit/{id}', [TransaksiDeliveredController::class, 'edit']) ->name('transaksi_delivered.edit');
        Route::post('/edit', [TransaksiDeliveredController::class, 'postEdit']) ->name('post.transaksi_delivered.edit');
    });

    Route::prefix('transaksi_pickup')->group(function(){
        Route::get('/', [TransaksiPickupController::class, 'index']) ->name('transaksi_pickup');
        Route::get('/tambah', [TransaksiPickupController::class, 'tambah']) ->name('transaksi_pickup.tambah');
        Route::post('/tambah', [TransaksiPickupController::class, 'postTambah']) ->name('post.transaksi_pickup.tambah');
        Route::get('/edit/{id}', [TransaksiPickupController::class, 'edit']) ->name('transaksi_pickup.edit');
        Route::post('/edit', [TransaksiPickupController::class, 'postEdit']) ->name('post.transaksi_pickup.edit');
    });
    Route::prefix('transaksi_reservasi')->group(function(){
        Route::get('/', [TransaksiReservasiController::class, 'index']) ->name('transaksi_reservasi');
        Route::get('/tambah', [TransaksiReservasiController::class, 'tambah']) ->name('transaksi_reservasi.tambah');
        Route::post('/tambah', [TransaksiReservasiController::class, 'postTambah']) ->name('post.transaksi_reservasi.tambah');
        Route::get('/edit/{id}', [TransaksiReservasiController::class, 'edit']) ->name('transaksi_reservasi.edit');
        Route::post('/edit', [TransaksiReservasiController::class, 'postEdit']) ->name('post.transaksi_reservasi.edit');
    });
    Route::prefix('invoice')->group(function(){
        Route::get('/', [InvoiceController::class, 'index']) ->name('invoice');
        Route::get('/tambah', [InvoiceController::class, 'tambah']) ->name('invoice.tambah');
        Route::post('/tambah', [InvoiceController::class, 'postTambah']) ->name('post.invoice.tambah');
        Route::get('/edit/{id}', [InvoiceController::class, 'edit']) ->name('invoice.edit');
        Route::post('/edit', [InvoiceController::class, 'postEdit']) ->name('post.invoice.edit');
        Route::get('/history', [InvoiceController::class, 'history']) ->name('invoice.history');
        Route::get('/bayar', [InvoiceController::class, 'postBayar']) ->name('invoice.bayar');
        Route::get('/batal', [InvoiceController::class, 'postBatal']) ->name('invoice.batal');



    });
    Route::prefix('produk_foto')->group(function(){
        Route::get('/', [ProdukJualController::class, 'index']) ->name('produk_foto');
        Route::get('/tambah', [ProdukJualController::class, 'tambah']) ->name('produk_foto.tambah');
        Route::post('/tambah', [ProdukJualController::class, 'postTambah']) ->name('post.produk_foto.tambah');
        Route::get('/edit/{id}', [ProdukJualController::class, 'edit']) ->name('produk_foto.edit');
        Route::post('/edit', [ProdukJualController::class, 'postEdit']) ->name('post.produk_foto.edit');
    });
    
    Route::prefix('admin')->group(function(){
        Route::get('/home',[HomeController::class,'index'])->name('admin.home');
    });

    Route::prefix('driver')->group(function(){
        Route::get('/',[DriverController::class,'index'])->name('driver');
        Route::get('/tambah',[DriverController::class,'tambah'])->name('driver.tambah');
        Route::post('/tambah',[DriverController::class,'postTambah'])->name('post.driver.tambah');
        Route::get('/edit/{id}', [DriverController::class, 'edit']) ->name('driver.edit');
        Route::post('/edit', [DriverController::class, 'postEdit']) ->name('post.driver.edit');
        Route::get('/driver', [DriverController::class, 'index_driver']) ->name('index.driver');
        Route::get('/driver_order', [DriverController::class, 'driver_order']) ->name('driver_order.tambah');
        Route::post('/driver_oder', [DriverController::class, 'postDriverOrderTambah']) ->name('post.driver_order.tambah');
        Route::get('/edit_order/{id}', [DriverController::class, 'edit_driver_order']) ->name('driver_order.edit');
        Route::post('/edit_order', [DriverController::class, 'postDriverOrderEdit']) ->name('post.driver_order.edit');

    });

    Route::prefix('notifikasi')->group(function(){
        Route::get('/',[NotifikasiController::class,'index'])->name('notifikasi');
        Route::get('/tambah',[NotifikasiController::class,'tambah'])->name('notifikasi.tambah');
        Route::post('/tambah',[NotifikasiController::class,'postTambah'])->name('post.notifikasi.tambah');
    });
});














<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\NotifikasiController;
use App\Http\Controllers\Api\PointController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController as ControllersProfileController;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/', function(){
//     return Hash::make('dedi123');
// });

Route::post('/login', [AuthController::class, 'postLogin']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::post('/cek-token', [AuthController::class, 'postCekToken']);
Route::post('/forget', [AuthController::class, 'postResetPassword']);
Route::get('/notifikasi', [NotifikasiController::class, 'notifikasi']);

// Route::post('/aktivasi', [AuthController::class, 'aktivasiAkun']);

Route::middleware('auth.user')->group(function(){
    Route::post('/logout', [AuthController::class, 'postLogout']);
    Route::get('pointandvoucher', [ProfileController::class, 'getPointAndVoucher']);
    
    Route::get('/produk', [ProdukController::class, 'index']);
    
    Route::post('/invoice', [InvoiceController::class, 'postIndex']);
    Route::get('/invoice', [InvoiceController::class, 'invoice']);
    Route::post('/invoice_tambah_jmlh', [InvoiceController::class, 'invoice_tambah_jmlh']);
    Route::post('/invoice_kurang_jmlh', [InvoiceController::class, 'invoice_kurang_jmlh']);
    Route::post('/invoice_delete_jmlh', [InvoiceController::class, 'invoice_delete_jmlh']);
    Route::get('/invoice/jumlah', [InvoiceController::class, 'invoice_jumlah']);
    Route::get('/invoice/list', [InvoiceController::class, 'list']);
    Route::post('/invoice/summary', [InvoiceController::class, 'invoice_summary']);
    Route::post('/invoice/checkout', [InvoiceController::class, 'invoice_checkout']);

    
    Route::get('/history', [InvoiceController::class, 'history']);

    Route::get('/voucher', [VoucherController::class, 'voucher_user']);
    Route::post('/voucherCek', [VoucherController::class, 'voucher_user_cek']);

    Route::post('/point', [PointController::class, 'point_user']);

    Route::post('/editProfile', [AuthController::class, 'editProfile']);
    Route::post('/editFoto', [AuthController::class, 'editFoto']);

    Route::post('/mapsSimpan', [AuthController::class, 'mapsSimpan']);
    Route::get('/maps', [AuthController::class, 'maps']);

    Route::get('/hitung-ongkir', [InvoiceController::class, 'hitungOngkir']);

    Route::get('/sesi_hari', [InvoiceController::class, 'sesi_hari']);
    Route::get('/sesi', [InvoiceController::class, 'sesi']);
});


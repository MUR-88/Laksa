<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Http\Controllers\ResponseController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{   
    public $response;
  
    function __construct()
    {
        $this->response = new ResponseController();
    }

    function notifikasi(){

        // $invoice = Invoice::where('status', 1)->get();
        $invoice_selesai_today = Invoice::where('status', 2)->whereDate('waktu_order', now())->count();
        $invoice_progress = Invoice::where('status', 1)->count();     
        $invoice_progress_today = Invoice::where('status', 1)->with('invoiceDetail.produk')->with('user')->get();
        $invoice_selesai_skrg = Invoice::where('status', 2)->with('invoiceDetail.produk')->with('user')->get();
        $invoice_uang_today = Invoice::where('status', 2)->whereDate('waktu_order', now())->sum('total');
        return $this->response->index(1, 200, 'Berhasil Mengambil data Notifikasi', 
        [
        //    'invoice' => $invoice,
           'invoice_selesai_today' => $invoice_selesai_today,
           'invoice_progres_today' => $invoice_progress_today,
           'invoice_progress' =>$invoice_progress,
           'invoice_uang_today' => $invoice_uang_today,
           'invoice_selesai_skrg' => $invoice_selesai_skrg,

        ]
    );
    }
}

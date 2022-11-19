<?php

namespace App\Http\Controllers\Scheduled;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BatalAutoController extends Controller
{
  
  public function __invoke(Request $request)
  {
    $waktu_batal = Carbon::now()->subMinutes(30);
    $invoice_check = Invoice::where('status_pembayaran', 1)->where('status', 1)->where('waktu_order', '<=', $waktu_batal)->get();
    foreach($invoice_check as $item){
      $item->update([
        'status_pembayaran' => 3,
        'gagal_at'=>now(),
        'status' => 2
      ]);
    }
    return $this->response->index(1, 200, 'success', 'Pembayaran Kadaluwarsa!');
      
  }
}

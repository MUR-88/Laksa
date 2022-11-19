<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PushNotification;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    function index_invoice($id){
        $invoice = Invoice::with(['invoiceDetail'=> function($query){
            $query->with('produk');
        }])->find($id);

        // return $invoice;
        return view('web_view/index',[
            'title'=> 'Invoice Payment #' . $invoice->id,
            'invoice' => $invoice
        ]);
    }
    
    function postBatalUser(Request $request){
        $invoice_batal = Invoice::find($request->id);
        if(!$invoice_batal){
            return redirect()->back()->with('error', 'Invoice batal tidak Berhasil Diupdate');
        }
        PushNotification::create([
            'user_id' => $invoice_batal->user_id,
            'invoice_id' => $invoice_batal->id,
            'judul' => 'Pesanan dengan ID#'. $invoice_batal->id .'akan kami proses',
            'isi' => 'Haii'. $invoice_batal->user_id . 'Pesanan Kami Telah dibatalkan, Kamu masih bisa pesan lagi:)',
            'tipe_suara' => 3,
            'is_with_sound' => 1,
            'is_admin' => 1
        ]);
        $invoice_batal->update([
            'status' => 3,
            'gagal_at' => now(),
        ]);

        return redirect()->route('webview.invoice.detail', [
            'id' => $invoice_batal->id
        ])->with('success', 'Berhasil membatalkan pesanan');
    }

    function index_faq(){
        return view('web_view/faq',[
            'title'=> 'Faq',
            'active' => 'alamat_user'
        ]);
    }
}

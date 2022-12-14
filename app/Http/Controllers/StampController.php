<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Produk;
use App\Models\PushNotification;
use App\Models\QrStamp;
use App\Models\Stamp;
use App\Models\User;
use Illuminate\Http\Request;


class StampController extends Controller
{
    function index (){
        return view('stamp/index', [
            'title'=>'stamp',
            'Stamp' => Stamp::get(),
            'active' => 'stamp'
        ]);
    }
    function tambah(){
        return view('stamp/tambah', [
            'title'=> 'Tambah Stamp',
            'produk' => Produk::get(),
            'active' => 'stamp',
        ]);
    }

    function postTambah(Request $request){
        $request->validate([
            'kode' => 'required',
            'produk_id' => 'required'
        ]);

        $qr_stamp = QrStamp::where('kode', $request->kode)->where('status', 0)->where('expired_at', '>=', now())->first();
        if(!$qr_stamp){
            return redirect()->back()->with('error', 'kode stamp sudah digunakan atau expired');
        }
        
        $produk = Produk::find($request->produk_id);
        if(!$produk){
            return redirect()->back()->with('error', 'Produk Id tidak ditemukan');
        }
        $invoice = Invoice::create([
            'user_id' => $qr_stamp->user_id,
            'status' => 1,
            'status_ordered' => 1,
            'status_pembayaran' =>1,
            'waktu_order' => now(),
            'ongkir' => 0,
            'catatan' => $request->catatan,
            'potongan' => 0,
            'tujuan_alamat' => 'stamp'
        ]);

        $invoice_detail = InvoiceDetail::create([
            'invoice_id' => $invoice->id,
            'jumlah' => 1,
            'harga' => $produk->harga,
            'produk_id' => $produk->id,
            'waktu_order' => now()
        ]);

        Stamp::create([
            'invoice_id' => $invoice->id,
            'user_id' => $qr_stamp->user_id,
            'nilai_stamp' => -10,
            'status' => 2,
            'kode' => ''
        ]);

        $qr_stamp->update([
           'status' => 2 
        ]);

        // PushNotification::create([
        //     'user_id' => $request->user_id,
        //     'judul' => $request->judul,
        //     'isi' => $request->isi,
        //     'is_admin' => $request->is_admin,
        //     'scheduled_at' => $request->scheduled_at,
        // ]);
        return redirect()->route('stamp')->with('success', 'Berhasil menggunakan Kode Stamp');
    }
    
}

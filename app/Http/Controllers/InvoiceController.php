<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function index (Request $request){
        $tanggal_awal = $request->input('tanggal_awal') ? Carbon::parse($request->input('tanggal_awal'))->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $tanggal_akhir = $request->input('tanggal_akhir') ? Carbon::parse($request->input('tanggal_akhir'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        return view('invoice/index', [
            'title'=>'invoice',
            'invoice' => Invoice::whereIn('status', [1, 2, 3])
                ->whereDate('created_at', '>=', $tanggal_awal)
                ->whereDate('created_at', '<=', $tanggal_akhir)->get(),
            'active' => 'invoice',
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir

        ]);
    }

    function detail (Request $request, $id){
        $invoice = Invoice::find($id);

        return view('invoice/detail', [
            'title'=>'invoice',
            'invoice' => $invoice,
            'active' => 'transaksi_delivered',
        ]);
    }

    function tambah(){
        return view('invoice/index', [
            'title'=> 'invoice',
            'invoice' => Invoice::get(),
            'active' => 'produk',
        ]);
    }
    
    function postTambah(Request $request){
        $request->validate([
            'Kode' => 'required',
            'status' => 'required|numeric',
            'status_pembayaran' => 'required|numeric',
            'status_ordered' => 'required|numeric',
            'tujuan_alamat' => 'required',
            'waktu_order' =>'nullable' ,
            'created_at' =>'nullable' ,
            'updated_at' =>'nullable' 

        ]);
    }

    function history(Request $request){
        $tanggal_awal = $request->input('tanggal_awal') ? Carbon::parse($request->input('tanggal_awal'))->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $tanggal_akhir = $request->input('tanggal_akhir') ? Carbon::parse($request->input('tanggal_akhir'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        
        return view('invoice/history', [
            'title' => 'History',
            'invoice' => Invoice::where('status', 2)->whereDate('waktu_order', '>=' , $tanggal_awal)->whereDate('waktu_order', '<=' , $tanggal_akhir)->get(),
            'active' => 'History',
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir

        ]);
    }

    function postBayar(Request $request){
        $invoice_bayar = Invoice::find($request->id);
        if(!$invoice_bayar){
            return redirect()->back()->with('error', 'Invoice Bayar tidak Berhasil Diupdate');
        }
        $invoice_bayar->update([
            'status_pembayaran' => 2
        ]);

        return redirect()->route('invoice')->with('success', 'Berhasil menghapus data');

    }

    function postBatal(Request $request){
        $invoice_batal = Invoice::find($request->id);
        if(!$invoice_batal){
            return redirect()->back()->with('error', 'Invoice batal tidak Berhasil Diupdate');
        }
        $invoice_batal->update([
            'status' => 3
        ]);
        return redirect()->route('invoice')->with('success', 'Berhasil membatalkan pesanan');
    }

    
    
}

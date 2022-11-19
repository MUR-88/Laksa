<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PushNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DriverViewController extends Controller
{
    function  DriverView(){
        return view('driver_view/index_view',[
            'title' => 'Driver Home',
            'invoice' => Invoice::where('status', 1)->where('status_pembayaran', 2)->where('status_ordered', 2)->get(),
        ]);
    }
    function driver_antar(Request $request){
        $request->validate([
            'id' => 'required',
            
        ]);
        
        $invoice = Invoice::find($request->id);
        if(!$invoice){
            return redirect()->back()->with('error', 'Delivery tidak Berhasil Diupdate');
        }
        $invoice->update([
            'status' => 2,
            'updated_at' => \Carbon\Carbon::parse($request->updated_at)
        ]);
        return redirect()->route('index_view')->with('success', 'Berhasil mengubah data driver');
        PushNotification::create([
            'user_id' => $invoice->user_id,
            'invoice_id' => $invoice->id,
            'judul' => 'Pesanan dengan ID#'. $invoice->id .'akan kami proses',
            'isi' => 'Pesanan Kami Telah Sampai, enjoy the meal!',
            'tipe_suara' => 1,
            'is_with_sound' => 1,
        ]);
    }
}

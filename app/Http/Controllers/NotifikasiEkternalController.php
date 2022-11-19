<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class NotifikasiEkternalController extends Controller
{
    function notifikasi (Request $request){
        // $tanggal_awal = $request->input('tanggal_awal') ? Carbon::parse($request->input('tanggal_awal'))->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        // $tanggal_akhir = $request->input('tanggal_akhir') ? Carbon::parse($request->input('tanggal_akhir'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        return view('notifikasi', [
            'title'=>'notifikasi',
            'invoice' => Invoice::where('status', 2)->get(),
            'invoice1' => Invoice::where('status', 1)->get(),
            'invoice2' => Invoice::where('status_pembayaran', 1)->get(),
            'invoice2' => Invoice::where('status_pembayaran', 3)->get(),
            // 'active' => 'notifikasi',
        ]);
    }
}

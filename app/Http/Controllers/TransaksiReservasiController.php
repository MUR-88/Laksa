<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
class TransaksiReservasiController extends Controller
{
    function index (){
        return view('transaksi_reservasi/index', [
            'title'=>'transaksi_reservasi',
            'transaksi_reservasi' => Invoice::where('status_ordered', 2)->where('status', 1)->get(),
            'active' => 'transaksi_reservasi'
        ]);
    }
}

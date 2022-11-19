<?php

namespace App\Http\Controllers;

use App\Models\TransaksiReservasi;

class TransaksiReservasiController extends Controller
{
    function index (){
        return view('transaksi_reservasi/index', [
            'title'=>'transaksi_reservasi',
            'transaksi_reservasi' => TransaksiReservasi::get(),
            'active' => 'transaksi_reservasi'

        ]);
    }
}

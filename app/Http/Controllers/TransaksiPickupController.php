<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPickup;

class TransaksiPickupController extends Controller
{
    function index (){
        return view('transaksi_pickup/index', [
            'title'=>'transaksi_pickup',
            'transaksi_pickup' => TransaksiPickup::get(),
            'active' => 'transaksi_pickup'
        ]);
    }
}

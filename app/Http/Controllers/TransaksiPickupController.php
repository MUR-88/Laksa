<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\TransaksiPickup;

class TransaksiPickupController extends Controller
{
    function index (){
        return view('transaksi_pickup/index', [
            'title'=>'transaksi_pickup',
            'transaksi_pickup' => Invoice::where('status_ordered', 1)->where('status', 1)->get(),
            'active' => 'transaksi_pickup'
        ]);
    }
}

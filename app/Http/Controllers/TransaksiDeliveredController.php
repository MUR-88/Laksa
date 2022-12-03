<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use App\Models\Invoice;
use App\Models\Produk;
use App\Models\TransaksiDelivered;
use App\Models\User;

class TransaksiDeliveredController extends Controller
{
    function index (){
        return view('transaksi_delivered/index', [
            'title'=>'Transaksi Delivered',
            'user' => User::get(),
            'transaksi_delivered' => Invoice::where('status_ordered', 2)->where('status', 1)->get(),
            'alamat' => AlamatUser::get(),
            'active' => 'transaksi_delivered'
        ]);
    }

    function tambah(){
        return view('transaksi_delivered/tambah',[
            'title'=>'Transaksi Delivered',
            'user' => User::get(),
            'invoice' => Invoice::get(),
            'alamat' => AlamatUser::get(),
            'transaksi_delivered' => TransaksiDelivered::get(),
            'active' => 'transaksi_delivered'
        ]);
    }

}

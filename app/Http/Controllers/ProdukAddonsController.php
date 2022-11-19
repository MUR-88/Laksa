<?php

namespace App\Http\Controllers;

use App\Models\ProdukAddons;
use Illuminate\Http\Request;

class ProdukAddonsController extends Controller
{
    function index (){
        return view('produkaddons/index', [
            'title'=>'produkaddons',
            'produkaddons' => ProdukAddons::get(),
            'active' => 'produkaddons'
        ]);
    }
}

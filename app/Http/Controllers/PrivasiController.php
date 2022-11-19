<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivasiController extends Controller
{
    public function privasi(){
        return view('privasi/index', [
            'title'=> 'kategori',
        ]);
    }
}

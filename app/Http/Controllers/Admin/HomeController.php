<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index (){
        return view('/Admin/index', [
            'title'=>'Home',
            'home_controller' => HomeController::get(),
            'active' => 'transaksi_delivered'
        ]);
    }
}

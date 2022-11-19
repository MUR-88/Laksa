<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index (){
        return view('dashboard/index', [
            'title'=>'Dashboard',
            'active' => 'dashboard',
            'invoice' => Invoice::get(),
        ]);
    }
}

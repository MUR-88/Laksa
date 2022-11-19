<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUser;
use App\Models\WebView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebViewController extends Controller
{
    function index_invoice(){
        return view('web_view/index',[
            'title'=>'Invoice Payment',
            'index_invoice' => WebView::get(),
        ]);
    }
}

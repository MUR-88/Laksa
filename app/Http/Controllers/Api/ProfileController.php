<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Stamp;
use App\Models\VoucherUser;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $response;
    function __construct()
    {
        $this->response = new ResponseController();
    }
    function getPointAndVoucher(Request $request){
        $voucher_user = VoucherUser::where('user_id', $request->user_id)
        ->where('expired_at', '>=', now())
        ->where('status', 0)->count();
        $stamp = Stamp::where('user_id', $request->user_id)->sum('nilai_stamp');

        return $this->response->index(1, 200, 'Berhasil mengambil data', [
            'stamp'=>$stamp,
            'voucher_user'=>$voucher_user
        ]);
    }
}

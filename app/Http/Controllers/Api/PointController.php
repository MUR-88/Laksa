<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\QrStamp;
use App\Models\Stamp;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
 

class PointController extends Controller
{
  public $response;
  
  function __construct()
  {
      $this->response = new ResponseController();
  }
  function point_user(Request $request){
    $stamp = Stamp::where('user_id', $request->user_id)->sum('nilai_stamp');
    if ($stamp >= 10)
    {
      do{
        $kode = strtoupper(Str::random(8));
        $qr_stamp = QrStamp::where('kode', $kode)->where('status', 0)->where('expired_at', '>=', now())->first();
      }while($qr_stamp);
      $qr_stamp_baru = QrStamp::create([
        'kode' => $kode,
        'user_id' => $request->user_id,
        'expired_at' => Carbon::now()->addMinutes(10),
        'status' => 0
      ]);
      return $this->response->index(1, 200, 'Berhasil Generate QR', $qr_stamp_baru);
    }else{
      return $this->response->index(0, 200, 'Point Tidak Mencukupi');
    }
  }
    
}
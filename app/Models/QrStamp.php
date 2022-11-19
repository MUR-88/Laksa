<?php

namespace App\Models;

use App\Http\Controllers\Api\PointController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrStamp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    ='qr_stamp';

    protected $appends =['kode_qr'];

    protected $guarded =[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getKodeQrAttribute(){
        return "LaksaPoint:".$this->kode;
    }
}

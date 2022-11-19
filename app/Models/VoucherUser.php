<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherUser extends Model
{
    use HasFactory, SoftDeletes;


    
    protected $table    ='voucher_users';

    protected $guarded =[];
    protected $appends =[
        'expired_at_formatted'
    ];

    public function voucher(){
        return $this->belongsTo(Voucher::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getExpiredAtFormattedAttribute(){
        if(now()->addDay() >= Carbon::parse($this->expired_at)){
            return [
                'alert' => true,
                'text' => Carbon::parse($this->expired_at)->locale('id')->diffForHumans(),
            ];
        } else {
            return [
                'alert' => false,
                'text' => Carbon::parse($this->expired_at)->locale('id')->isoFormat('dddd, Do MMMM YYYY HH:mm'),
            ];
        }
    }
}

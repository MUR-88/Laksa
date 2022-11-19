<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PushNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'push_notification';
    protected $guarded =[];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }
}

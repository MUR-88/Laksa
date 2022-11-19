<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginLogs extends Model
{
    use HasFactory ;
    protected $table = 'login_logs';

    protected $fillable = [
        'user_id',
        'admin_id',
        'token',
        'status'
    ];

    public function user(){
        return $this->belongsTo('\App\Models\User', 'user_id');
    }
}

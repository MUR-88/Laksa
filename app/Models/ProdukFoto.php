<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukFoto extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'produk_foto';

    protected $guarded = [];

    public function getFotoAttribute($value){
        return asset('storage/'. $value);
    }
}



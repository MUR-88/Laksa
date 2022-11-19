<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukAddons extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk_addons';

    protected $guarded = [];

    public function addons(){
        return $this->belongsTo(Addons::class);
    }

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}

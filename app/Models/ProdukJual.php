<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ProdukJual';

    protected $guarded = [];

    public function getIconAttribute($value){
        return asset('storage/'. $value);
    }

    public function produk(){
        return $this->hasMany(Produk::class);
    }
}

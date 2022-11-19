<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori';

    protected $guarded = [];

    public function getIconAttribute($value){
        return asset('storage/'. $value);
    }
    public function getIconActiveAttribute($value){
        if($value){
            return asset('storage/'. $value);
        }else{
            return null;
        }
    }

    public function produk(){
        return $this->hasMany(Produk::class);
    }
}

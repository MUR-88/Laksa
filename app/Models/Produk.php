<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';

    protected $guarded = [];

    protected $appends = [
        'harga_formatted',
  

    ];

    public function getHargaFormattedAttribute(){
        return "Rp.". number_format($this->harga, 0, ',', '.');
    }

    public function produkFoto(){
        return $this->hasMany(ProdukFoto::class);
    }
    public function produkFotoFirst(){
        return $this->hasOne(ProdukFoto::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class)->withTrashed();
    }

    public function produkAddons(){
        return $this->hasMany(ProdukAddons::class);
    }
}



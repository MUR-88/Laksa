<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;


    protected $table    ='voucher';

    protected $guarded =[];

    protected $appends = [
        'potongan_beli_formatted ',
        'potongan_harga_formatted', 
        'max_beli_formatted', 
        'max_potongan_formatted', 
        'limmit_formatted',
        'created_at_formatted',
        'expired_at_formatted',
        'updated_at_formatted',
        'potongan_harga_formatted'

    ];

    public function getPotonganBeliFormattedAttribute(){
        return "Rp.". number_format($this->potongan_beli, 0, ',', '.');
    }

    public function getPotonganHargaFormattedAttribute(){
        return "Rp.". number_format($this->potongan_harga, 0, ',', '.');
    }

    public function getMaxBeliFormattedAttribute(){
        return "Rp.". number_format($this->potongan_harga, 0, ',', '.');
    }

    public function getMaxPotonganFormattedAttribute(){
        return "Rp.". number_format($this->potongan_harga, 0, ',', '.');
    }

    public function getLimmitFormattedAttribute(){
        return "Rp.". number_format($this->potongan_harga, 0, ',', '.');
    }

    public function getCreatedAtFormattedAttribute(){
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('dddd, Do MM YYYY HH:mm');
    }

    public function getExpiredAtFormattedAttribute(){
        return Carbon::parse($this->expired_at)->locale('id')->isoFormat('dddd, Do MM YYYY HH:mm');
    }

    public function getUpdatedAtFormattedAttribute(){
        return Carbon::parse($this->updated_at)->locale('id')->isoFormat('dddd, Do MM YYYY HH:mm');
    }

    public function getFotoAttribute($value){
        return asset('storage/'. $value);
    }

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
    
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function voucherUser(){
        return $this->hasMany(Kategori::class);
    }
}

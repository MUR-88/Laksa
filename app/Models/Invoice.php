<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    ='invoice';

    protected $guarded =[];

    protected $appends = [
        'waktu_order_formatted', 'total_formatted'
    ];
    public function getWaktuOrderFormattedAttribute(){
        return Carbon::parse($this->waktu_order)->locale('id')->isoFormat('dddd, Do MMM YYYY HH:mm');
    }
    public function getTotalFormattedAttribute(){
        $total = $this->total;
        return "Rp. ". number_format($total, 0, ',', '.');
    }
    public function getOngkirFormattedAttribute(){
        $ongkir = $this->ongkir;
        return "Rp. ". number_format($ongkir, 0, ',', '.');
    }
    public function getOngkirDriverFormattedAttribute(){
        $ongkir_driver = $this->ongkir_driver;
        return "Rp. ". number_format($ongkir_driver, 0, ',', '.');
    }
    public function invoiceDetail(){
        return $this->hasMany(InvoiceDetail::class);
    }
    public function invoiceDetailFirst(){
        return $this->hasOne(InvoiceDetail::class);
        
    }
    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function voucherUser(){
        return $this->belongsTo(VoucherUser::class);
    }
    public function alamatUser(){
        return $this->belongsTo(AlamatUser::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function produkFoto(){
    //     return $this->belongsTo(ProdukFoto::class);
    // }
    public function produkAddons(){
        return $this->hasMany(ProdukAddons::class);
    }

    public function invoiceReservasi(){
        return $this->hasOne(InvoiceReservasi::class)->withTrashed();
    }
}

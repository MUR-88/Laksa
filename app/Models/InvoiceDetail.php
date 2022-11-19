<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'invoice_detail';

    protected $guarded = [];

    protected $appends = ['subtotal', 'harga_with_addons', 'subtotal_formatted', 'harga_with_addons_formatted'];

    public function getSubtotalAttribute(){
        $harga_addons = $this->invoiceDetailAddons->sum(function($invoiceDetailAddons){
            return $this->jumlah * ($invoiceDetailAddons->harga * $invoiceDetailAddons->jumlah);
        });

        return ($this->harga * $this->jumlah) + $harga_addons;
    }

    public function getHargaWithAddonsAttribute(){
        $harga_with_addons = $this->invoiceDetailAddons->sum(function($invoiceDetailAddons){
            return ($invoiceDetailAddons->harga * $invoiceDetailAddons->jumlah);
        });

        return $this->harga + $harga_with_addons  ;

    }

    public function getSubtotalFormattedAttribute(){
        $subtotal = $this->getSubtotalAttribute();
        return "Rp. ". number_format($subtotal, 0, ',', '.');
    }

    public function getHargaWithAddonsFormattedAttribute(){
        $harga_with_addons_formatted = $this->getHargaWithAddonsAttribute();
        return "Rp. ". number_format($harga_with_addons_formatted, 0, ',', '.');
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function produk(){
        return $this->belongsTo(Produk::class);
    }

    public function invoiceDetailAddons(){
        return $this->hasMany(InvoiceDetailAddons::class);
    }

}

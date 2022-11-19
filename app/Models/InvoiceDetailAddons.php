<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetailAddons extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'invoice_detail_addons';

    protected $guarded = [];

    public function invoiceDetail(){
        return $this->belongsTo(InvoiceDetail::class);
    }
    public function produkAddons(){
        return $this->belongsTo(ProdukAddons::class);
    }
    
}

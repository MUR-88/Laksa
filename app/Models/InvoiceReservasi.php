<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceReservasi extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'invoice_reservasi';

    protected $guarded = [];
    
    public function User(){
        return $this->belongsTo(User::class);
    }
    
    public function Invoice(){
        return $this->belongsTo(Invoice::class);
    }
    
    public function invoiceDetail(){
        return $this->belongsTo(InvoiceDetail::class);
    }
}

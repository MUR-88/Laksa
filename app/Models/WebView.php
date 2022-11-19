<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebView extends Model
{
    use HasFactory;
    
    protected $table    ='invoice';

    protected $guarded =[];
}

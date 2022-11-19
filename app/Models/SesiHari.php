<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SesiHari extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sesi_hari';

    protected $guarded =[];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlamatUser extends Model
{
    use HasFactory,SoftDeletes;

    protected $table    ='alamat_user';

    protected $guarded =[];
}

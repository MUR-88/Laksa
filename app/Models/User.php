<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravolt\Avatar\Facade as AvatarFacade;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, SoftDeletes, Notifiable;
 

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'google_id',
        'no_hp',
        'nama',
        'foto',
        'email',
        'password',
        'email_verified_at',
    ];
    
    public function alamatuser(){
        return $this->hasMany(AlamatUser::class);
    }

    public function getFotoAttribute($value){
        return asset('storage/'. $value);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
}

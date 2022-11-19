<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use Illuminate\Http\Request;

class AlamatUserController extends Controller
{
    function index (){
        return view('alamat_user/index', [
            'title'=>'alamat_user',
            'alamat_user' => AlamatUser::get(),
            'active' => 'alamat_user'
        ]);
    }
}

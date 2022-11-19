<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function index (){
        // return Hash::make('Babi789');   
        return view('profile/index', [
            'title'=>'profile',
            'profile' => User::get(),
            'active' => 'profile'
        ]);
    }
}

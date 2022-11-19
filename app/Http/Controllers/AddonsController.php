<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use Illuminate\Http\Request;

class AddonsController extends Controller
{
    function index (){
        return view('addons/index', [
            'title'=>'Addons',
            'addons' => Addons::get(),
            'active' => 'addons'
        ]);
    }
    function tambah(){
        return view('addons/tambah', [
            'title'=> 'Addons',
            'addons' => Addons::get(),
            'active' => 'addons'
        ]);
    }
    function postTambah(Request $request){
        $request->validate([
            'nama' => 'required',
            'is_multiple'=>'nullable|numeric',
            'is_required'=>'nullable|numeric'

        ], [
            'nama.required' => 'Nama harus diisi'
        ]);


        Addons::create([
            'nama' => $request->nama,
            'is_multiple'=>$request->is_multiple ? 1 : 0,
            'is_required'=>$request->is_required ? 1 : 0,
        ]);

        return redirect()->route('addons')->with('success', 'Berhasil menambahkan data addons');
    }
    function edit($id){
        return view('addons/edit', [
            'title'=>'Addons',
            'addons' => Addons::find($id),
            'active' => 'addons'
        ]);
    }

    function postEdit(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required',
            'is_multiple' => 'nullable',
            'is_required' => 'nullable',
        ]);

        $addons = Addons::find($request->id);
        if(!$addons){
            return redirect()->back()->with('error', 'addons tidak ditemukan');
        }


        $addons->update([
            'nama' => $request->nama,
            'is_multiple'=>$request->is_multiple ? 1 : 0,
            'is_required'=>$request->is_required ? 1 : 0,
        ]);

        return redirect()->route('addons')->with('success', 'Berhasil mengubah data Addons');

    }

}

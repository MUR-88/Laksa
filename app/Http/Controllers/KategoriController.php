<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    function index (){
        return view('kategori/index', [
            'title'=> 'kategori',
            'kategori' => Kategori::get(),
            'active' => 'kategori',      
        ]);
    }
    
    function tambah(){
        return view('kategori/tambah', [
            'title'=> 'kategori',
            'kategori' => Kategori::get(),
            'active' => 'kategori'
        ]);
    }

    function postTambah(Request $request){
        $request->validate([
            'nama' => 'required',
            'icon' => 'required|image',
            'icon_active' => 'nullable|image'

        ], [
            'nama.required' => 'Nama harus diisi'
        ]);

        $icon = Storage::disk('public')->put('images/kategori', $request->file('icon'));
        $icon_active = Storage::disk('public')->put('images/kategori', $request->file('icon_active'));

        Kategori::create([
            'nama' => $request->nama,
            'icon' => $icon,
            'icon_active' => $icon_active,
        ]);

        return redirect()->route('kategori')->with('success', 'Berhasil menambahkan data kategori');
    }

    function edit($id){
        return view('kategori/edit', [
            'title'=> 'Edit Kategori',
            'kategori' => Kategori::find($id),
            'active' => 'kategori'
        ]);
    }

    function postEdit(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required',
            'icon' => 'nullable|image',
            'icon_active' => 'nullable|image'

        ]);

        $kategori = Kategori::find($request->id);
        if(!$kategori){
            return redirect()->back()->with('error', 'Kategori tidak ditemukan');
        }

        if($request->hasFile('icon')){
            $icon = Storage::disk('public')->put('images/kategori', $request->file('icon'));
            $kategori->update([
                'icon' => $icon,

            ]);
        }
        if($request->hasFile('icon_active')){
            $icon_active = Storage::disk('public')->put('images/kategori', $request->file('icon_active'));
            $kategori->update([
                'icon_active' => $icon_active,

            ]);
        }

        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kategori')->with('success', 'Berhasil mengubah data kategori');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Voucher ;

class VoucherController extends Controller
{
    function index (){
        return view('voucher/index', [
            'title'=>'voucher',
            'voucher' => Voucher::get(),
            'active' => 'voucher'
        ]);
    }
    function tambah(){
        return view('voucher/tambah', [
            'title'=> 'voucher',
            'voucher' => Voucher::get(),
            'produk' => Produk::get(),
            'kategori' => Kategori::get(),
            'is_piblic'=> 'is_piblic',
            'is_available'=> 'is_available',
            'active' => 'voucher',
        ]);
    }
    function postTambah(Request $request){
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'deskripsi' => 'required',
            'potongan_harga' => 'nullable',
            'potongan_beli' => 'nullable',
            'min_item' => 'nullable',
            'min_beli' => 'nullable',
            'produk_id' => 'nullable|numeric',
            'max_potongan' => 'nullable',
            'kategori_id' => 'nullable|numeric',
            'potongan_ongkir' => 'nullable|numeric',
            'limmit' => 'nullable',
            'expired_time'=>'required|numeric',
            'kode' => 'required|string',
            'is_public' =>'required' ,
            'is_available' =>'required' ,
        ], [
            'nama.required' => 'Nama harus diisi',
            'kode.required' => 'kode harus diisi',
        ]);

        $foto = Storage::disk('public')->put('images/voucher', $request->file('foto'));

        Voucher::create([
            'nama' => $request->nama,
            'foto' => $foto,
            'deskripsi' => $request->deskripsi,
            'potongan_harga' => $request->potongan_harga,
            'potongan_beli' => $request->potongan_beli,
            'min_item' => $request->min_item,
            'min_beli' => $request->min_beli,
            'max_potongan' => $request->max_potongan,
            'potongan_ongkir' => $request->potongan_ongkir,
            'kategori_id' => $request->kategori_id,
            'produk_id' => $request->produk_id,
            'limmit' => $request->limmit,
            'kode' => $request->kode,
            'expired_time'=> $request->expired_time,
            'is_public' =>$request->is_public ? 1 : 0,
            'is_available' =>$request->is_available ? 1 : 0,
            
        ]);

        return redirect()->route('voucher')->with('success', 'Berhasil menambahkan data voucher');
    }
    function edit($id){
        return view('voucher/edit', [
            'title'=> 'Edit voucher',
            'voucher' => Voucher::find($id),
            'produk' => Produk::get(),
            'kategori' => Kategori::get(),
            'active' => 'voucher',
        ]);
    }
    
    function postEdit(Request $request){
        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image',
            'deskripsi' => 'nullable',
            'potongan_harga' => 'nullable',
            'potongan_beli' => 'nullable',
            'min_item' => 'nullable',
            'min_beli' => 'nullable',
            'max_potongan' => 'nullable',
            'limmit' => 'nullable',
            'kategori_id' => 'nullable|numeric',
            'expired_time'=>'nullable|numeric',
            'kode' => 'required|string',
            'is_public' =>'nullable' ,
            'is_available' =>'nullable' ,
            'active' => 'voucher',
        ]);

        $voucher = Voucher::find($request->id);
        if($request->hasFile('foto')){
            $path_foto = Storage::disk('public')->put('images/voucher', $request->file('foto'));
            $voucher->update([
            'foto' => $path_foto,
            ]);
        }
        $voucher->update([
            'nama' =>$request->nama,
            'deskripsi' =>$request->deskripsi,
            'potongan_harga' =>$request->potongan_harga,
            'potongan_beli' =>$request->potongan_beli,
            'min_item' =>$request->min_item,
            'min_beli' =>$request->min_beli,
            'max_potongan' =>$request->max_potongan,
            'limmit' =>$request->limmit,
            'expired_time'=>$request->expired_time,
            'kategori_id'=>$request->kategori_id,

            'kode' =>$request->kode,
            'is_public' =>$request->is_public ? 1 : 0,
            'is_available' =>$request->is_available ? 1 : 0,
        ]);

        return redirect()->route('voucher')->with('success', 'Berhasil mengubah data Voucher');

    }
    function produk(Request $request){
        $data = Produk::where('kategori_id', $request->kategori_id)->get();
        return $data;

    }

    }


  
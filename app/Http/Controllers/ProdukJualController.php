<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\ProdukAddons;
use App\Models\ProdukFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Whoops\Run;

class ProdukJualController extends Controller
{
    function index (){
        // return Hash::make('Babi789');   

        // return Produk::find(1)->kategori->id;
        // struktur data json item
        // return Produk::with('produkFoto')->with('kategori')->get();
        return view('produk/index', [
            'title'=>'produk',
            'produk' => Produk::get(),
            'active' => 'produk'
        ]);
    }

    function postCollaps(Request $request){
        $produk_addons = ProdukAddons::with('addons')->where('produk_id', $request->input('id'))->get();
        
        return $produk_addons;
    }

    function tambah(){
        return view('produk/tambah', [
            'title'=> 'produk',
            'produk' => Produk::get(),
            'active' => 'produk',
            'deskripsi' => 'required',
            'kategori' => Kategori::all()
        ]);
    }
    function postTambah(Request $request){
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|numeric',
            'deskripsi' => 'required',
            'is_available' =>'required' ,
        ]);

        // Validasi kategori
        $kategori = Kategori::find($request->kategori_id);
        if(!$kategori){
            return redirect()->back()->with('error', 'produk tidak ditemukan');
        }

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'is_available' => $request->is_available ? 1 : 0
        ]);

        return redirect()->route('produk')->with('success', 'Berhasil menambahkan data produk');
    }
    function edit($id){
        return view('produk/edit', [
            'title'=> 'Edit produk',
            'produk' => produk::find($id),
            'kategori' => Kategori::all(),
            'active' => 'produk',
        ]);
    }

    function postEdit(Request $request){
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'nullable',
            'is_available' => 'nullable',
        ]);

        $produk = produk::find($request->id);
        if(!$produk){
            return redirect()->back()->with('error', 'produk tidak ditemukan');
        }


        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'is_available' => $request->is_available ? 1 : 0,
        ]);

        return redirect()->route('produk')->with('success', 'Berhasil mengubah data produk');
    }

    function addons(Request $request){
        return view('produk.addons', [
            'title'=> 'Produk Addons',
            'produk' => Produk::find($request->input('produk_id')),
            'addons' => Addons::get(),
            'data_addons' => Addons::whereHas('produkAddons', function($query) use ($request){
                $query->where('produk_id', $request->input('produk_id'));
            })->get(),
            'active' => 'produk'
        ]);
    }

    function postAddons(Request $request){
        $request->validate([
            'produk_id' => 'required|numeric',
            'addons_id' => 'required|numeric',
            'harga' => 'required|numeric|min:0',
            'nama' => 'required'
        ]);

        $addons = Addons::find($request->addons_id);
        if(!$addons){
            return redirect()->back()->with('error', 'Addons tidak ada');
        }

        $produk = Produk::find($request->produk_id);
        if(!$produk){
            return redirect()->back()->with('error', 'Produk tidak ada');
        }

        ProdukAddons::create([
            'produk_id' => $request->produk_id,
            'addons_id' => $request->addons_id,
            'harga' => $request->harga,
            'nama' => $request->nama,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambah data');
    }

    function postAddonsEdit(Request $request){
        $request->validate([
            'produk_addons_id' => 'required|numeric',
            'harga' => 'required|numeric|min:0',
            'nama' => 'required'
        ]);

        ProdukAddons::find($request->produk_addons_id)->update([
            'harga' => $request->harga,
            'nama' => $request->nama,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }
    function addonsHapus(Request $request){
        ProdukAddons::find($request->produk_addons_id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    function foto(Request $request){
        return view('produk.foto', [
            'title'=> 'Foto',
            'produk' => Produk::find($request->input('produk_id')),
            'active' => 'produk'
        ]);
    }

    public function postFotoTambah(Request $request){
        $request->validate([
            'foto' => 'image|required',
            'produk_id' => 'numeric|required'
        ]);

        $path_foto = Storage::disk('public')->put('images/produk', $request->file('foto'));
        ProdukFoto::create([
            'produk_id' => $request->produk_id,
            'foto' => $path_foto,
        ]);
        return redirect()->back()->with('success', 'Berhasil Menambahkan fot data');

    }

    public function postFotoHapus(Request $request){
        $request->validate([
            'produk_foto_id' => 'required|exists:produk_foto,id'
        ]);

        ProdukFoto::find($request->produk_foto_id)->delete();

        return redirect()->back()->with('success', 'berhasil menghapus foto');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\Kategori;
use App\Models\ProdukAddons;
use Illuminate\Http\Request;
use stdClass;

class   ProdukController extends Controller
{
    public $response;
    function __construct()
    {
        $this->response = new ResponseController();
    }

    function index(){
        $kategori = Kategori::with(['produk' => function($query){
            $query->with('produkFoto');
        }])->get();

        foreach($kategori as $item){
            foreach($item->produk as $produk){
                $produk->harga_formatted = "Rp. " . number_format($produk->harga, 0, ',', '.');
                $addons = Addons::all();
                foreach($addons as $item_addons){
                    $produk_addons = ProdukAddons::where('produk_id', $produk->id)
                    ->where('addons_id', $item_addons->id)->get();

                    foreach($produk_addons as $item_produk_addons) {
                        $item_produk_addons->harga_formatted = "Rp. " . number_format($item_produk_addons->harga, 0, ',' , '.');
                    }

                    if(count($produk_addons) > 0){
                        $item_addons->produk_addons = $produk_addons;
                    }
                }

                $produk->addons = $addons;
            }
        }

        return $this->response->index(1, 200, 'Berhasil mengambil data', $kategori);
    }
}

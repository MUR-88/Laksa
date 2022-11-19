<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public $response;
    public $InvoiceController;

    function __construct()
    {
        $this->response = new ResponseController();
        $this->InvoiceController = new InvoiceController();
    }
    public function getExpiredAtFormattedAttribute(){
        return Carbon::parse($this->expired_at)->locale('id')->isoFormat('dddd, Do MM YYYY ');
    }
    
    function voucher_user(Request $request) {
        $voucher_user = VoucherUser::where('user_id', $request->user_id)
        ->where('expired_at', '>=', now())
        ->with('voucher')
        ->where('status', 0)->get();

        return $this->response->index(1, 200, 'Berhasil mengambil data', $voucher_user
        );
    }

    function voucher_user_cek(Request $request) {
        $validator = Validator::make($request->all(), [
            'voucher_user_id' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->response->index(1, 422, $validator->errors()->first());
        }

        $voucher_user = VoucherUser::where('user_id', $request->user_id)->find($request->voucher_user_id);
        if(!$voucher_user){
            return $this->response->index(0, 200, 'Voucher Tidak Valid');
        }

        if(Carbon::parse($voucher_user->expired_at) <= now()){
            return $this->response->index(0, 200, 'voucher Expired');
        }

        //validasi min_beli, min_item, is_available, limmit, kategori_id, produk_id
        //aksi potongan harga, potongan persen, max potongan, potongan beli, potongan ongkir

        $invoice_detail = InvoiceDetail::whereHas('invoice', function($query) use ($request){
            $query->where('user_id', $request->user_id)->where('status', 0);
        })->get();
            
        $jumlah_item = collect($invoice_detail)->sum('jumlah');


        $jumlah_beli = 0;
        $jumlah_penggunaan_voucher = 0;

        foreach($voucher_user->voucher->voucherUser as $voucherUser ){
            if($voucherUser->status == 1){
                $jumlah_penggunaan_voucher = $jumlah_penggunaan_voucher +1;
            }
        }

        foreach($invoice_detail as $item ){
            $jumlah_beli += ($item->jumlah*$item->harga);
            foreach($item->invoiceDetailAddons as $invoiceDetailAddons){
                $jumlah_beli += ($invoiceDetailAddons->jumlah * $invoiceDetailAddons->harga);
            }
        }


        if($voucher_user->voucher->min_beli && $jumlah_beli >= $voucher_user->voucher->min_beli){
            return $this->response->index(0, 200, 'minimal pembelian terpenuhi');
        }

        if($voucher_user->voucher->min_item && $jumlah_item >= $voucher_user->voucher->min_item){
            return $this->response->index(0, 200, 'minimal item terpenuhi');
        }

        if($voucher_user->voucher->is_available == 0){
            return $this->response->index(0, 200, 'voucher tidak tersedia');
        }

        if($voucher_user->voucher->limmit <= $jumlah_penggunaan_voucher){
            return $this->response->index(0, 200, 'limit tidak tersedia');
        }

        if($voucher_user->voucher->kategori_id ){
            $kategori_id = [];
            foreach($invoice_detail as $item){
                foreach($item->produk as $produk){
                    if(!in_array($produk->kategori->id, $kategori_id)){
                        array_push($kategori_id, $produk->kategori->id);
                    }
                }
            }
            $voucher = Voucher::whereIn('kategori_id', $kategori_id)->find($voucher_user->voucher->id);
            if(!$voucher){
                return $this->response->index(0, 200, 'voucher tidak memenuhi S&K');
            }
        }

        if($voucher_user->voucher->produk_id ){
            $produk_id = [];
            foreach($invoice_detail as $item){
                foreach($item->produk as $produk){
                    if(!in_array($produk->id, $produk_id)){
                        array_push($produk_id, $produk->id);
                    }
                }
            }
            $voucher = Voucher::whereIn('produk_id', $produk_id)->find($voucher_user->voucher->id);
            if(!$voucher){
                return $this->response->index(0, 200, 'voucher tidak memenuhi S&K');
            }
        }

        if(!$invoice_detail->invoice->alamat_user_id){
            return $this->response->index(0, 200, 'Isi alamat dahulu');
        }

        $client = new Client();
        $latitude = $invoice_detail->invoice->alamatUser->latitude;
        $longitude = $invoice_detail->invoice->alamatUser->longitude;

        $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$latitude,$longitude&origins=0.408106,101.873139&key=". config('app.apikey.maps'));
        
        $response = $response->getBody();
        $response = json_decode($response);

        if($response->rows[0]->elements[0]->status != 'OK'){
            return $this->response->index(0, 200, 'Jalur tidak ditemukan');
        }

        $jarak = $response->rows[0]->elements[0]->distance;
        
        $total = $jumlah_beli;
        $potongan_harga = 0;
        // $potongan_persen = 0;

        $ongkir = $this->fungsiHitungOngkir($jarak->value);

        //aksi potongan persen, max potongan, potongan beli, potongan ongkir

        // if($voucher_user->voucher->potongan_harga){
        //     $potongan_harga = $voucher_user->voucher->potongan_harga;
        // }

        if($voucher_user->voucher->potongan_persen){
            $potongan_persen = $voucher_user->voucher->potongan_persen;
            $potongan_harga = $total * $potongan_persen / 100;
        }
        
        if($voucher_user->voucher->potongan_beli){
            $potongan_beli = $voucher_user->voucher->potongan_beli;
            $potongan_harga = $potongan_beli;
        }

        if($voucher_user->voucher->potongan_ongkir){
            $potongan_ongkir = $voucher_user->voucher->potongan_ongkir;
            $potongan_harga = $ongkir - $potongan_harga;
        }

        if($potongan_harga > $voucher_user->voucher->max_potongan){
            $potongan_harga = $voucher_user->voucher->max_potongan;

        }
        return $this->response->index(1, 200, 'berhasil ', [
            'total' => $total,
            'potongan_harga' => $potongan_harga,
            'ongkir' => $ongkir,
            'total_pembayaran' => $total + $ongkir - $potongan_harga
        ]);
    }

}

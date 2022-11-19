<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\AlamatUser;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoiceDetailAddons;
use App\Models\InvoiceReservasi;
use App\Models\Produk;
use App\Models\ProdukAddons;
use App\Models\PushNotification;
use App\Models\Sesi;
use App\Models\SesiHari;
use App\Services\InvoiceService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class InvoiceController extends Controller
{
    public $response;
    public $invoiceService;
    function __construct()
    {    
        $this->response = new ResponseController();
        $this->invoiceService = new InvoiceService();
    }

    function postIndex(Request $request){
        // Cek invoice ada atau tidak
        $invoice = Invoice::where('user_id', $request->user_id)->where('status', 0)->first();
        if(!$invoice){
            $invoice = Invoice::create([
                'user_id' => $request->user_id,
                'status' => 0,
                'status_pembayaran' => 0,
                'status_ordered' => 0,
                'tujuan_alamat' => '',
                'waktu_order' => NULL,
                'alamat_user_id' => AlamatUser::where('user_id', $request->user_id)->latest()->first()?->id
            ]);
        }

        // Validasi
        $validator = Validator::make($request->all(), [
            'produk.id' => 'required',
            'addons' => 'array',
            'addons.*.addons_id' => 'required',
            'addons.*.produk_addons.*.produk_addons_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->response->index(0, 422, $validator->errors()->first());
        }
        $produk = Produk::find($request->produk['id']);
        if(!$produk){
            return $this->response->index(0, 200,'produk gak ada');
        }

        $invoiceDetail = InvoiceDetail::create([
            // 'isinya'
            'invoice_id' => $invoice->id,
            'jumlah' => 1,
            'harga' => $produk->harga,
            'produk_id' => $produk->id,
            'waktu_order'=> now()
        ]);

        foreach($request->addons as $addons){
            if(array_key_exists('produk_addons', $addons)){
                foreach($addons['produk_addons'] as $produk_addons){
                    $check_produk_addons = ProdukAddons::find($produk_addons['produk_addons_id'])
                    ;
                    if(!$check_produk_addons){
                        return $this->response->index(0, 200, 'Produk Addons Tidak Ditemukan');
                    }
                    if($produk_addons['is_checked']){
                        InvoiceDetailAddons::create([
                            'invoice_detail_id' => $invoiceDetail->id,
                            'jumlah'=>1,
                            'produk_addons_id' => $produk_addons['produk_addons_id'],
                            'harga' => $check_produk_addons->harga
                        ]);
                    }
                }
            }
        }
        
        return $this->response->index(1, 200,'Berhasil menambah data invoice');
    }

    function hitungOngkir(Request $request){
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'status_code' => 422,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $client = new Client();
            $latitude = $request->latitude;
            $longitude = $request->longitude;
    
            $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$latitude,$longitude&origins=0.408106,101.873139&key=". config('app.apikey.maps'));
            
            $response = $response->getBody();
            $response = json_decode($response);
    
            if($response->rows[0]->elements[0]->status != 'OK'){
                return $this->response->index(0, 200, 'Jalur tidak ditemukan');
            }
    
            $jarak = $response->rows[0]->elements[0]->distance;
            
            $ongkir = $this->fungsiHitungOngkir($jarak->value);
            if($jarak->value >= 100001){
                return $this->response->index(0,200,'jarak terlalu jauh');
            }
            return $this->response->index(1, 200, 'Berhasil', [
                'ongkir' => $ongkir,
                'jarak' => $jarak
            ]);
        } catch (Throwable $error) {
            return $this->response->index(0, 500, "Terjadi kesalahan: " .$error->getMessage());
        }
    }

    function fungsiHitungOngkir($jarak){
        $ongkir = 0;

        for ($i = 1; $i <= $jarak; $i = $i + 500) { 
            if($i <= 3000){
                $ongkir = $ongkir + 800;
            }
            if($i >= 3001 && $i <=5000){
                $ongkir = $ongkir + 1200;
            }
            if($i >= 5001 && $i <=7500){
                $ongkir = $ongkir + 1500;
            }
            if($i >= 7501 && $i <=100000){
                $ongkir = $ongkir + 2000;
            }
        }
        
        $ongkir = round($ongkir, -3);

        return [
            'ongkir' => $ongkir,
            'ongkir_formatted' => 'Rp.'. number_format($ongkir, 0, ',', '.')
        ];
    }

    function invoice(Request $request){
        $invoice = Invoice::where('user_id', $request->user_id)->with(['alamatUser','invoiceDetail'  => function($query){
            $query->with('produk')
                ->with('invoiceDetailAddons.produkAddons')
                ->with(['produk' => function($query){ $query->with('produkFoto');
            }]);
        }])->where('status', 0 )->first();
        return $this->response->index(1, 200, 'berhasil mengambil invoice', $invoice);
    }
 
   function invoice_tambah_jmlh(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $invoice_tambah_jmlh = InvoiceDetail::whereHas('invoice', function($query) use ($request){
            $query->where('user_id', $request->user_id);
        })->find($request->id);

        if(!$invoice_tambah_jmlh){
            return $this->response->index(0, 200, 'error', 'Quantiti tidak bisa ditambah');
        }

        $invoice_tambah_jmlh->update([
            'jumlah' => $invoice_tambah_jmlh->jumlah + 1,
            
        ]);

        return $this->response->index(1, 200, 'success', 'Quantiti telah ditambah');
    }
    function invoice_kurang_jmlh(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $invoice_detail = InvoiceDetail::whereHas('invoice', function($query) use ($request){
            $query->where('user_id', $request->user_id);
        })->find($request->id);

        if(!$invoice_detail){
            return $this->response->index(0, 200, 'error', 'Quantiti tidak bisa Mengurangi pesanan');
        }
        if($invoice_detail->jumlah == 1){
            $invoice_detail->delete();
            return $this->response->index(1, 200, 'sucsses' );
        }

        $invoice_detail->update([
            'jumlah' => $invoice_detail->jumlah - 1,
            
        ]);

        return $this->response->index(1, 200, 'success', 'Quantiti berhasil dikurangi');
    }

    function invoice_delete_jmlh(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $invoice_detail = InvoiceDetail::whereHas('invoice', function($query) use ($request){
            $query->where('user_id', $request->user_id);
        })->find($request->id);

        if(!$invoice_detail){
            return $this->response->index(0, 200, 'Error', 'Invoice sudah dihapus');
        }

        $invoice_detail->delete();

        return $this->response->index(1, 200, 'success', 'Quantiti dihapus');

    }

    function invoice_summary(Request $request){
        $validator = Validator::make($request->all(), [
            'voucher_user_id' => 'nullable|exists:voucher_users,id',
            'jarak' => 'nullable|numeric|min:0',
        ]);

        if($validator->fails()){
            return $this->response->index(0, 422, $validator->errors()->first());
        }

        $response = $this->invoiceService->currentInvoice($request->user_id)
            ->calculateSummary($request->voucher_user_id, $request->jarak);

        return $this->response->index($response['status'], 200, $response['message'], array_key_exists('data', $response) ? $response['data'] : null);
    }

    function sesi(Request $request){
        $sesi = Sesi::get();

        return $this->response->index(1, 200, 'berhasil mengambil data sesi', $sesi);
    }

    function invoice_jumlah(Request $request){
        $invoice = InvoiceDetail::whereHas('invoice', function($query) use ($request) {
          $query->where('user_id', $request->user_id)
          ->where('status', 0 );
        })->count();
        return $this->response->index(1, 200, 'berhasil mengambil invoice', $invoice);
    }

    function history(Request $request){
        $history = Invoice::where('user_id', $request->user_id )->with('invoiceDetail.invoiceDetailAddons')
        ->where('status_pembayaran', 2 ) 
        // status pembayaran selesai
        ->get();
        return $this->response->index(1, 200, 'berhasil mengambil invoice', $history);
    }
  

    function sesi_hari(){
        $sesi_hari = SesiHari::first();
        return $this->response->index(1, 200, 'berhasil mengambil data sesi hari', $sesi_hari);
    }

    function list(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:berjalan,selesai'
        ]);

        if($validator->fails()){
            return $this->response->index(0, 422, $validator->errors()->first());
        }
        
        if($request->status == 'berjalan'){
            $status= [1];
        }else{
            $status = [2,3];
        }
        $invoice_selesai = Invoice::with('invoiceDetailFirst.produk.produkFotoFirst')
        ->withCount('invoiceDetail')->whereIn('status', $status)->paginate(15);
        return $this->response->index(1, 200, 'Berhasil Mengambil data Invoice selesai', $invoice_selesai);
    }

    function postCheckout(Request $request){
        $invoice = Invoice::find('id');

        PushNotification::create([
            'user_id' => $invoice->user_id,
            'invoice_id' => $invoice->id,
            'judul' => 'Pesanan dengan ID#'. $invoice->id .'akan kami proses',
            'isi' => 'Haii'. $invoice->user_id->nama . 'Pesanan Kami Telah dibuat, Silahkan Lakukan Pembayaran Yahh :)',
            'tipe_suara' => 1,
            'is_with_sound' => 1,
        ]);
    }

    function invoice_checkout(Request $request){
        $validator = Validator::make($request->all(), [
            'status_ordered' => 'required|in:1,2,3',
            'voucher_user_id' => 'nullable|exists:voucher_users,id'
        ], [
            'reservasi.jmlh_orang.min' => 'Jumlah orang minimal 1'
        ]);

        if($validator->fails()){
            return $this->response->index(0, 422, $validator->errors()->first());
        }

        if($request->status_ordered != 3 ){
            $validator = Validator::make($request->all(), [
                'sesi' => 'nullable|required_if:status_ordered,2|date',
            ]);

            if($validator->fails()){
                return $this->response->index(0, 422, $validator->errors()->first());
            }
        }

        if($request->status_ordered == 3){
            $validator = Validator::make($request->all(), [
                'reservasi' => 'nullable|required_if:status_ordered,3|array',
                'reservasi.jmlh_orang' => 'required_if:status_ordered,3|numeric|min:1',
                'reservasi.waktu_kedatangan' => 'required_if:status_ordered,3|date',
                'reservasi.nama' => 'required_if:status_ordered,3',
                'reservasi.kontak' => 'required_if:status_ordered,3',
            ], [
                
            ]);
    
            if($validator->fails()){
                return $this->response->index(0, 422, $validator->errors()->first());
            }
        }


        if($request->status_ordered == 2){
            if(Carbon::parse($request->sesi)->lt(now())){
                return $this->response->index(0, 200, 'Waktu lampau');
            }
        }

        $invoice = (new InvoiceService())->currentInvoice($request->user_id);
        $invoice = $invoice->invoice;

        if($request->status_ordered == 2){
            if(!$invoice->alamatUser){
                return $this->response->index(0, 200, 'Pilih alamat terlebih dahulu');
            }
        }
        
        $response = (new InvoiceService())->currentInvoice($request->user_id)->calculateSummary($request->voucher_user_id, $invoice->alamatUser ? $invoice->alamatUser->jarak : 0);
        if($response['status'] == 0){
            return $this->response->index(0, 200, $response['message']);
        }

        try {
            $invoice->update([
                'status' => 1,
                'status_ordered' => $request->status_ordered,
                'ongkir' => $response['data']['ongkir'],
                'potongan' => $response['data']['potongan_harga'],
                'total' => $response['data']['total'],
                'voucher_user_id' => $request->voucher_user_id,
                'sesi' => $request->status_ordered == 3 ? $invoice->sesi : '',
                'tujuan_alamat' => $invoice->alamatUser ? $invoice->alamatUser->keterangan : '',
                'latitude' => $invoice->alamatUser ? $invoice->alamatUser->latitude : null,
                'langitude' => $invoice->alamatUser ? $invoice->alamatUser->longitude : null,
                'catatan' => $request->catatan
            ]);

            if($request->status_ordered == 3){
                InvoiceReservasi::create([
                    'invoice_id' => $invoice->id,
                    'waktu_kedatangan' => $request->waktu_kedatangan,
                    'jmlh_orang' => $request->jmlh_orang,
                    'nama' => $request->nama,
                    'kontak' => $request->kontak
                ]);
            }

            PushNotification::create([
                'user_id' => $invoice->user_id,
                'invoice_id' => $invoice->id,
                'judul' => 'Pesanan dengan ID#'. $invoice->id .'akan kami proses',
                'isi' => 'Haii '. $invoice->user->nama . 'Pesanan Kami Telah dibuat, Silahkan Lakukan Pembayaran Yahh :)',
                'tipe_suara' => 1,
                'is_with_sound' => 1,
            ]);

            return $this->response->index(1, 200, 'Sukses');
        } catch (\Exception $error) {
            return $this->response->index(0, 500, $error->getMessage());
        }
    }
}

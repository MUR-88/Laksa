<?php

namespace App\Services;

use App\Models\Invoice;
use GuzzleHttp\Client;

class InvoiceService {
    public $invoice;

    function currentInvoice($user_id){
        $invoice = Invoice::where('user_id', $user_id)
            ->with(['alamatUser','invoiceDetail'  => function($query){
                $query->with('produk.produkFoto')
                    ->with('invoiceDetailAddons.produkAddons');
        }])->where('status', 0 )->first();

        $this->invoice = $invoice;
        return $this;
    }

    function calculateSummary($voucher_user_id, $jarak){
        $voucherService = new VoucherService();
        
        try {
            $ongkir = $this->calculateOngkir($jarak);
            $harga = $this->invoice->invoiceDetail->sum(function($invoiceDetail){
                $harga_detail = $invoiceDetail->harga * $invoiceDetail->jumlah;
                $harga_detail_addons = $invoiceDetail->invoiceDetailAddons->sum(function($invoiceDetailAddons) use ($invoiceDetail){
                    return $invoiceDetail->jumlah * ($invoiceDetailAddons->harga * $invoiceDetailAddons->jumlah);
                });
                return $harga_detail + $harga_detail_addons;
            });

            $potongan_harga = 0;
            if($voucher_user_id){
                $response_potongan_harga = $voucherService->setVoucherUser($voucher_user_id)->calculateVoucherUser($this->invoice, $ongkir['ongkir']);
                if($response_potongan_harga['status'] == 1){
                    $potongan_harga = $response_potongan_harga['data']['potongan'];
                } else {
                    $potongan_harga = 0;
                }
            }

            return [
                'status' => 1,
                'message' => 'Sukses',
                'data' => [
                    'pesan_voucher' => $voucher_user_id ? $response_potongan_harga['message'] : null,
                    'harga' => $harga,
                    'potongan_harga' => $potongan_harga,
                    'ongkir' => $ongkir['ongkir'],
                    'total' => $harga - $potongan_harga + $ongkir['ongkir'],

                    'harga_formatted' => "Rp.". number_format($harga, 0, ',', '.'),
                    'potongan_harga_formatted' => "Rp.". number_format($potongan_harga, 0, ',', '.'),
                    'ongkir_formatted' => $ongkir['ongkir_formatted'],
                    'total_formatted' => "Rp." . number_format($harga - $potongan_harga + $ongkir['ongkir']),
                ]
            ];
        } catch (\Exception $error){
            return [
                'status' => 0,
                'message' => $error->getMessage()
            ];
        }
    }

    static function calculateJarak($latitude, $longitude){
        try {
            $client = new Client();
    
            $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$latitude,$longitude&origins=0.408106,101.873139&key=". config('app.apikey.maps'));
            
            $response = $response->getBody();
            $response = json_decode($response);
    
            if($response->rows[0]->elements[0]->status != 'OK'){
                return [
                    'status' => 0,
                    'message' => 'Jalur tidak ditemukan'
                ];
            }
    
            $jarak = $response->rows[0]->elements[0]->distance;
            
            if($jarak->value >= 100001){
                return [
                    'status' => 0,
                    'message' => 'jarak terlalu jauh'

                ];
            };
            return [
                'status' => 1,
                'message' => 'Berhasil menghitung jarak',
                'data' => [
                    'jarak' => $jarak
                ]
            ];
        } catch (\Throwable $error) {
            return [
                "status" =>0,
                "message" => "Terjadi kesalahan: " .$error->getMessage()
            ];
        }
    }

    function calculateOngkir($jarak){
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

    function checkout(){
        
    }
}
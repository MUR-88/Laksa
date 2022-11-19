<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\VoucherUser;
use Carbon\Carbon;

class VoucherService {
    private $voucher_user_id;

    function setVoucherUser($voucher_user_id){
        $this->voucher_user_id = $voucher_user_id;        
        return $this;
    }

    function calculateVoucherUser(Invoice $invoice, $ongkir){
        $voucher_user = VoucherUser::with('voucher')->where('id', $this->voucher_user_id)->first();
        if(Carbon::parse($voucher_user->expired_at)->lt(now()) ){
            return [
                'status' => 0,
                'message' => "Voucher sudah expired"
            ];
        };
        
        if($voucher_user->voucher->is_available == 0){
            return [
                'status' => 0,
                'message' => "Voucher sudah tidak tersedia"
            ];
        }
        // validasi min. item
        $jumlah_item = $invoice->invoiceDetail->sum('jumlah');
        if($voucher_user->voucher->min_item >= $jumlah_item){
            return [
                'status' => 0,
                'message' => 'Min item tidak mencukupi'
            ];
        }
        
        // validasi min. beli
        $total_beli = $invoice->invoiceDetail->sum(function($invoiceDetail){
            $harga_detail = $invoiceDetail->harga * $invoiceDetail->jumlah;
            $harga_detail_addons = $invoiceDetail->invoiceDetailAddons->sum(function($invoiceDetailAddons) use ($invoiceDetail){
                return $invoiceDetail->jumlah * ($invoiceDetailAddons->harga * $invoiceDetailAddons->jumlah);
            });
            return $harga_detail + $harga_detail_addons;
        });

        if($voucher_user->voucher->min_beli >= $total_beli){
            return [
                'status' => 0,
                'message' => "Minimal Pembelian belum tercukupi"
            ];
        };

        //validasi limmit
        $user_use_voucher = VoucherUser::where('voucher_id', $voucher_user->voucher_id)->where('status', 1)->count();
        if($voucher_user->voucher->limmit && $user_use_voucher >= $voucher_user->voucher->limmit){
            return[
                'status' => 0,
                'message' => "Limit Voucher sudah Habis"
            ];
        };

        // validasi kategori
        $kategori_id_array = $invoice->invoiceDetail->map(function($invoiceDetail){
            return $invoiceDetail->produk->kategori_id;
        })->unique()->values()->all();
        if($voucher_user->voucher->kategori_id && !$voucher_user->voucher->whereIn('kategori_id', $kategori_id_array)){
            return [
                'status' => 0,
                'message' => "Produk tidak sesuai dengan kategori"
            ];
        };

        $produk_id_array = $invoice->invoiceDetail->map(function($invoiceDetail){
            return $invoiceDetail->produk->id;
        })->unique()->values()->all();
        if($voucher_user->voucher->produk_id  && !$voucher_user->voucher->whereIn('produk_id', $produk_id_array)){
            return [
                'status' => 0,
                'message' => "Produk tidak Promo"
            ];
        };

        $potongan = 0;

        $voucher = $voucher_user->voucher;

        // potongan beli
        if($voucher->potongan_beli){
            $potongan = $voucher->potongan_beli;
        }

        // potongan persen
        if($voucher->potongan_persen){
            $potongan += $voucher->potongan_persen / 100 * $total_beli ;
        }

        //potongan harga per item
        if($voucher->potongan_harga && ($voucher->kategori_id || $voucher->produk_id)){
            if($voucher->kategori_id){
                $jumlah_item_kategori = $invoice->invoiceDetail->sum(function($invoiceDetail) use ($voucher){
                    if($invoiceDetail->produk->kategori_id == $voucher->kategori_id){
                        return $invoiceDetail->jumlah;
                    } else {
                        return 0;
                    }
                });
                $potongan += ($voucher->potongan_harga * $jumlah_item_kategori);
            } else {
                $jumlah_item_produk = $invoice->invoiceDetail->sum(function($invoiceDetail) use ($voucher){
                    if($invoiceDetail->produk_id == $voucher->produk_id){
                        return $invoiceDetail->jumlah;
                    } else {
                        return 0;
                    }
                });
                $potongan += ($voucher->potongan_harga * $jumlah_item_produk);
            }
        }
        
        //potongan ongkir
        if($voucher->potongan_ongkir){
            $potongan += $voucher->potongan_ongkir;
            if($potongan > $ongkir){
                $potongan = $ongkir;
            }
        }
        
        if($voucher->max_potongan && $potongan > $voucher->max_potongan){
            $potongan = $voucher->max_potongan;
        }
        
        if($potongan > $total_beli){
            $potongan = $total_beli;
        }

        return [
            'status' => 1,
            'message' => 'Berhasil menggunakan voucher',
            'data' => [
                'potongan' => $potongan
            ],
        ];
    }
}

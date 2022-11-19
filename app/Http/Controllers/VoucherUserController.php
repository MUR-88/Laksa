<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    function index (){
        return view('voucher_user/index', [
            'title'=>'voucher_user',
            'voucher_user' => VoucherUser::get(),
            'active' => 'voucher_user'

        ]);
    }
    function tambah (Request $request){
        $voucher = null;
        $voucher_selected = null;
        
        $voucher = Voucher::get();
        if($request->input('id')){
            $voucher_selected = Voucher::find($request->id);
        }
        return view('voucher_user/tambah', [
            'title' => 'voucher_user',
            'active' => 'voucher_user',
            'user' => User::get(),
            'voucher' => $voucher,    
            'voucher_selected' => $voucher_selected,    
        ]);
    }
    function postTambah (Request $request){
        $request->validate([
            'voucher_id' => 'required',
            'user_id' => 'required',
            
        ]);
        $voucher=Voucher::find($request->voucher_id);
        VoucherUser::create([
            'user_id'=> $request->user_id,
            'voucher_id'=>$request->voucher_id,
            'status'=>0,
            'keterangan'=>'',
            'expired_at'=>Carbon::now()->addMinutes($voucher->expired_time)
        ]);
    return redirect()->route('voucher_user')->with('success', 'Berhasil menambahkan data kategori');
    }

    function edit(Request $request, $voucher_user_id) {
        $voucher = null;
        $voucher_selected = null;
        
        $voucher_user = Voucher::get();
        if($request->input('id')){
            $voucher_selected = Voucher::find($request->id);
        }
        return view('voucher_user/edit', [
            'title'=>'voucher_user',
            'voucher_user' => VoucherUser::find($voucher_user_id),
            'active' => 'voucher_user',
            'user' => User::get(),
            'voucher' => Voucher::get(),    
            'voucher_selected' => $voucher_selected, 
        ]);
    }
    function postEdit (Request $request){
        $request->validate([
            'user_id' => 'required',
            'voucher_id' => 'required',
            'status' => 'nullable',
            'expired_at'=>'required|date',
            
        ]);
        $voucher_user = VoucherUser::find($request->id);
        if(!$voucher_user){
            return redirect()->back()->with('error', 'Voucher tidak Berhasil Diupdate');
        }
        $voucher_user->update([
            'voucher_id' => $request->voucher_id,
            'user_id' => $request->user_id,
            'status' => $request->status ? 1 : 0,
            'expired_at' => \Carbon\Carbon::parse($request->expired_at),
        ]);
        return redirect()->route('voucher_user')->with('success', 'Berhasil mengubah data voucher user');
        
    }
    function voucherHapus(Request $request){
        VoucherUser::find($request->voucher_user_id)->delete();

        return redirect()->route('voucher_user')->with('success', 'Berhasil menghapus data');
    }

}
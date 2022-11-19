<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Invoice;
use App\Models\PushNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotifikasiController extends Controller
{
    function index (Request $request){
        $tanggal_awal = $request->input('tanggal_awal') ? Carbon::parse($request->input('tanggal_awal'))->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $tanggal_akhir = $request->input('tanggal_akhir') ? Carbon::parse($request->input('tanggal_akhir'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        return view('notifikasi/index', [
            'title'=>'notifikasi',
            'notifikasi' => PushNotification::get(),
            'active' => 'notifikasi',
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
    }

    function tambah(){
        return view('notifikasi/tambah', [
            'title'=> 'notifikasi Tambah',
            'user' => User::get(),
            'notifikasi' => PushNotification::get(),
            'active' => 'notifikasi',
        ]);
    }

    function postTambah (Request $request){
        $request->validate([
            'user_id' => 'nullable',
            'judul' => 'required',
            'isi' => 'required',
            'is_admin' => 'nullable',
            'scheduled_at' => 'nullable',
            'foto' => 'image|nullable'
        ]);

        $path_foto = null;

        if($request->hasFile('foto')){
            $path_foto = Storage::disk('public')->put('images/notifikasi', $request->file('foto'));
        }
        PushNotification::create([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'is_admin' => $request->is_admin,
            'scheduled_at' => $request->scheduled_at,
            'foto' => $path_foto,
        ]);

        return redirect()->route('notifikasi')->with('success', 'Berhasil menambahkan notifikasi');
    }
}

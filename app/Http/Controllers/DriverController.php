<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    function index (){
        return view('driver/index', [
            'title'=>'driver',
            'driver' => Driver::get(),
            'active' => 'driver'

        ]);
    }

    function tambah(){
        return view('driver/tambah', [
            'title'=> 'Driver Tambah',
            'driver' => Driver::get(),
            'active' => 'driver',
        ]);
    }

    function postTambah(Request $request){
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'email.required' => 'Email harus diisi',
        ]
        );

        Driver::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('driver')->with('success', 'Berhasil menambahkan data driver');
    }

    function edit($id){
        return view('driver/edit', [
            'title'=> 'Driver Edit',
            'driver' => Driver::find($id),
            'active' => 'driver',
        ]);
    }

    function postEdit (Request $request){
        $request->validate([
            'nama' => 'nullable',
            'no_hp' => 'nullable',
            'email' => 'nullable',
            'password'=>'nullable',
            
        ]);
        $driver = Driver::find($request->id);
        if(!$driver){
            return redirect()->back()->with('error', 'Driver tidak Berhasil Diupdate');
        }
        $driver->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('driver')->with('success', 'Berhasil mengubah data driver');
    }

    function index_driver (){
        return view('driver/index_driver', [
            'title'=>'index_driver',
            'index_driver' => Invoice::whereNotNull('driver_id')->where('status', 1)->where('status_pembayaran', 2)->where('status_ordered', 2)->with('driver')->get(),
            'active' => 'index_driver'

        ]);
    }

    function driver_order (Request $request){
        $invoice = null;
        $invoice_selected = null;
        
        $invoice = Invoice::where('status', 1)->where('status_pembayaran', 2)->where('status_ordered', 2)->get();
        $driver = null;
        $driver_selected = null;

        $driver = Driver::get();

        if($request->input('id')){
            $invoice_selected = Invoice::find($request->id);
        }

        if($request->input('id')){
            $driver_selected = Driver::find($request->id);
        }
        return view('driver/driver_order', [
            'title'=>'index_driver',
            'driver_order' => Driver::get(),
            'invoice' => $invoice,
            'invoice_selected' => $invoice_selected,
            'driver' => $driver,
            'driver_selected' => $driver_selected,
            'user' => User::get(),
            'active' => $invoice_selected

        ]);
    }

    function postDriverOrderTambah (Request $request){
        $request->validate([
            'driver_id' => 'required',
            'invoice_id' => 'required',
        ]);

        $invoice = Invoice::find($request->invoice_id);
        if(!$invoice){
            return redirect()->back()->with('error', 'Invoice tidak ditemukan');
        }

        $invoice->update([
            'driver_id' => $request->driver_id,
            'status' => 1,


        ]);

        return redirect()->route('index.driver')->with('success', 'Berhasil menambahkan data driver');
    }

    function edit_driver_order (Request $request, $id){
        return view('driver/edit_order', [
            'title'=>'Edit Driver Order',
            'invoice_selected' => Invoice::find($id),
            'driver_selected' => Driver::find($request->input('driver_id')),
            'driver' => Driver::get(),
            'invoice' => Invoice::where('status', 1)->where('status_ordered', 2)->get(),
            'active' => 'driver_order'

        ]);
    }
    function postDriverOrderEdit (Request $request,){
        $invoice = null;
        
        $invoice = Invoice::get();
        $driver_selected = null;

        $driver = Driver::get();

        if($request->input('id')){
            $invoice_selected = Invoice::find($request->id);
        }

        if($request->input('id')){
            $driver_selected = Driver::find($request->id);
        }
        $request->validate([
            'driver_id' => 'nullable',
            'invoice_id' => 'nullable',
        ]);

        $invoice = Invoice::find($request->invoice_id);
        if(!$invoice){
            return redirect()->back()->with('error', 'Invoice tidak ditemukan');
        }

        $invoice->update([
            'driver_id' => $request->driver_id,
        ]);
        return redirect()->route('index.driver')->with('success', 'Berhasil menambahkan data driver');

    }

    
}
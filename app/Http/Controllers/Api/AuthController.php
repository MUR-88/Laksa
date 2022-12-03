<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\AlamatUser;
use App\Models\Invoice;
use App\Models\LoginLogs;
use App\Models\User;
use App\Models\UserOtp;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as AvatarFacade; 
use Throwable;

class AuthController extends Controller
{
  public $response;
  function __construct()
  {   
    $this->response = new ResponseController();        
  }

  function postLogin(Request $request){
    $validator = Validator::make($request->all(), [
        'email_no_hp' => 'required',
        'password' => 'required'
    ]);

    if($validator->fails()){
        return $this->response->index(1, 422, $validator->errors()->first());
    }

    $user = User::where('no_hp', $request->email_no_hp)->with(['alamatUser'=>function ($query){
        $query -> orderBy('id', 'desc') -> limit(1);
    }])->first();

    if(!$user){
        $user = User::where('email', $request->email_no_hp)->with(['alamatUser'=>function ($query){
            $query -> orderBy('id', 'desc') -> limit(1);
        }])->first();
    }

    if(!$user){
        return response([
            'status_code' => 200,
            'status ' => 0,
            'message' => 'User tidak ditemukan'
        ]);
    }

    if($user->email_verified_at == null){
        return $this->response->index(0, 200, 'Mohon verifikasi email terlebih dahulu');
    }

    if(!Hash::check($request->password, $user->password)){
        return $this->response->index(0, 200, 'Password kamu salah');
    }

    $token = Str::random(40);

    LoginLogs::create([
        'user_id' => $user->id,
        'token' => $token,
        'status' => 1
    ]);

    $encoded_token = base64_encode(json_encode([
        'token' => $token,
        'user_id' => $user->id
    ]));

    return $this->response->index(1, 200, 'Berhasil login', [
        'token' => $encoded_token,
        'user' => $user
    ]);
}

  function postRegister(Request $request){
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'no_hp' => 'required',
        'nama' => 'required',
        'password' => 'required',
        'confirm_password' => 'required|same:password'
    ]);

    if($validator->fails()){
        return $this->response->index(0, 422, $validator->errors()->first());
    }

    // Cek user udah ada atau belum
    $user = User::where('no_hp', $request->no_hp)->first();
    if($user){
        return $this->response->index(0, 200, 'User dengan No. HP sudah terdaftar');
    }
    
    // Cek lagi email nya
    $user = User::where('email', $request->email)->first();
    if($user){
        return $this->response->index(0, 200, 'User dengan Email sudah terdaftar');
    }
    
    $unique_name = now()->timestamp . '_' . str()->random(20).'.jpg';
    $path_foto = public_path('storage/images/user/' . $unique_name);
    AvatarFacade::create($request->nama)->save($path_foto);

    $user = User::create([
        'google_id' => NULL,
        'no_hp' => $request->no_hp,
        'nama' => $request->nama,
        'email'=> $request ->email,
        'password'=> Hash::make($request->password),
        'email_verified_at'=> NULL,
        'foto' => 'images/user/' . $unique_name
    ]);

    UserRegistered::dispatch($user);

    return $this->response->index(1, 200, 'Please Check email inbox or spam, and click the link for account activation');
  }

  function aktivasi(Request $request){
    $user_otp = UserOtp::where('token', $request->input('token'))
    ->where('user_id', $request->input('user_id'))->first();

    if(!$user_otp){
        return 'Aktivasi tidak valid';
    }

    if(strtotime(now()) > strtotime($user_otp->expired_at)){
        return 'Link aktivasi expired';
    }


    $user_otp->user->update([
        'email_verified_at' => now()
    ]);

    return 'Berhasil aktivasi';
  }

  function postCekToken(Request $request){
    try {
        $token = $request->header('token');

        $token = base64_decode($token);
        $token = json_decode($token);

        $login_logs = LoginLogs::where('user_id', $token->user_id)
        ->where('token', $token->token)
        ->where('status', 1)->first();
        
        if(!$login_logs){
            return $this->response->index(0, 200, 'Belum login bro');
        }

        $user = User::with(['alamatUser'=>function ($query){
            $query -> orderBy('id', 'desc') -> limit(1);
        }])->find($token->user_id);

        return $this->response->index(1, 200, 'Berhasil login', [
            'user' => $user
        ]);
    } catch (Throwable $error) {
        return $this->response->index(0, 200, 'Error');
    }
  }

  function postLogout(Request $request){
    try {
        $token = $request->header('token');

        $token = base64_decode($token);
        $token = json_decode($token);

        $login_logs = LoginLogs::where('user_id', $token->user_id)
        ->where('token', $token->token)
        ->where('status', 1)->first();
        
        if(!$login_logs){
            return $this->response->index(0, 200, 'Gagal logout jangan coba2');
        }

        $login_logs->update([
            'status' => 0
        ]);

        return $this->response->index(1, 200, 'Berhasil logout');
    } catch (Throwable $error) {
        return $this->response->index(0, 200, 'Error ');
    }
  }

  function editProfile(Request $request){
    $request->validate([
        'nama' => 'required',
        'no_hp' => 'required',

    ]);

    $EditProfile = User::with('alamatUser')->find($request->user_id);
    if(!$EditProfile){
        return $this->response->index(0, 200, 'User tidak ada');
    }

    if($request->nama != $EditProfile->nama){
        $unique_name = now()->timestamp . '_' . str()->random(20).'.jpg';
        $path_foto = public_path('storage/images/user/' . $unique_name);
        AvatarFacade::create($request->nama)->save($path_foto);

        $EditProfile->update([
            'foto' => 'images/user/'. $unique_name
        ]);
    }

    $EditProfile->update([
        'nama' => $request->nama,
        'no_hp' => $request->no_hp
    ]);

    return $this->response->index(1, 200, 'Berhasil edit profile', $EditProfile);
  }

  function editFoto(Request $request){
    $validator = Validator::make($request->all(), [
        'foto' => 'file:jpg,jpeg,png',
    ], [
        'foto.image' => 'Harus format foto yang valid'
    ]);

    if ($validator->fails()) {
        return $this->response->index(0, 200, $validator->errors()->first());
    }

    try {
        $path_foto = Storage::disk('public')->put('images/user', $request->file('foto'));
    
        $user = User::find($request->user_id);
        $user->update([
            'foto' => $path_foto
        ]);
    
        return $this->response->index(1, 200, 'Berhasil mengubah foto', [
            'foto' => $user->foto
        ]);
    } catch (\Exception $e) {
        return $this->response->index(0, 500, $e->getMessage());
    }
}


  function mapsSimpan(Request $request){
    $request->validate([
        'latitude' => 'required',
        'longitude' => 'required',
        'keterangan' => 'required'

    ]);

    $alamat_user = null;
    if($request->alamat_user_id){
      $alamat_user = AlamatUser::where('user_id', $request->user_id)->find($request->alamat_user_id);
    }

    $response_jarak = InvoiceService::calculateJarak($request->latitude, $request->longitude);
    if($response_jarak['status'] == 0){
        return $this->response->index(0, 200, $response_jarak['message']);
    }

    if($alamat_user){
      $alamat_user->update([
        'user_id' => $request->user_id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'keterangan' => $request->keterangan,
        'jarak' => $response_jarak['data']['jarak']->value
      ]);
    } else{
      $alamat_user = AlamatUser::create([
        'user_id' => $request->user_id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'keterangan' => $request->keterangan,
        'jarak' => $response_jarak['data']['jarak']->value
      ]);
    }
    
    $invoice = Invoice::where('user_id', $request->user_id)->where('status', 0)
      ->orderBy('id', 'DESC')->first();

    $invoice->update([
      'alamat_user_id' => $alamat_user->id,
      'tujuan_alamat' => $invoice->tujuan_alamat
    ]);

    return $this->response->index(1, 200, 'berhasil membuat data alamat user');


    // if(!mapsSimpan)
  }

//   function maps(Request $request){

//   }

    function postResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.email' => 'Silahkan Masukkan email'
        ]);
    
        if ($validator->fails()) {
            return $this->response->index(0, 422, $validator->errors()->first());
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                ? $this->response->index(1, 200, __($status))
                :$this->response->index(0, 200, __($status));
    }

    // function aktivasiAkun(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email'
    //     ]);

    //     if($validator->fails()){
    //         return $this->response->index(0, 422, $validator->errors()->first());
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     if(!$user){
    //         return $this->response->index(0, 200, 'User tidak ditemukan');
    //     }

    //     $user->sendEmailVerificationNotification();

    //     return $this->response->index(1, 200,' yeah');
    // }


    function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
    
}

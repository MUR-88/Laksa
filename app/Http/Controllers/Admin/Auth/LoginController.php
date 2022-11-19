<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function loginForm(){
        // return Hash::make('Babi789');
        return view('/admin/index', [
            'title'=>'Login',
            'active' => 'admin'
        ]);
    }

    function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]) 
        && !Auth::guard('driver')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->back()->with('error', 'Password salah');
        }
        $admin = null;
        $driver = null;
        if(Auth::guard('driver')->attempt(['email' => $request->email, 'password' => $request->password])){
            $driver = Driver::where('email', $request->email)->first();
        }
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            $admin = Admin::where('email', $request->email)->first();
        }

        // if(!Auth::login($admin)){
        //     return redirect()->route('produk');
        // } else{
        //     return redirect()->route('driver_view');
        // }

        if($admin){
            Auth::guard('admin')->login($admin);
            return redirect()->route('dashboard');
        }
        if($driver){
            Auth::guard('driver')->login($driver);
            return redirect()->route('index_view');
        }
        
    }

    function ResetPass(Request $request) { 
        $token = $request->token;
        $email = $request->email;

        return view('/reset_password/index', [
            'title'=>'Reset Password',
            'user' => User::where('email', $request->email)->firstOrFail(),
            'email'=>$email,
            'token'=>$token
        ]);

    }

    function postResetPass(Request $request){
        $request->validate([
            'email' => 'required',
            'token' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
     
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('success.password.reset')->with('status', __($status))
                : back()->with('error', __($status));
    }

    function success(){
        return view('/reset_password/success', [
            'title'=>'Berhasil ',
        ]);
    }

    function verification(Request $request){
        $user = User::find($request->input('id'));

        if(!$user){
            return 'user tidak ada';
        }

        if (!hash_equals((string) $request->input('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if ($user->markEmailAsVerified())
            event(new Verified($user));

        return view('/verification/index', [
            'title'=>'Berhasil ',
        ]); 
    }   

    function succesVerification(){
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\LoginLogs;
use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $login_logs = LoginLogs::where('token', $request->session()->get('token'))
            ->whereNotNull('admin_id')
            ->where('status', 1)->first();

        if(!$login_logs){
            return redirect()->route('login');
        }
        
        $request->user_id = $login_logs->user_id;

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use App\Models\LoginLogs;
use Closure;
use Illuminate\Http\Request;
use Throwable;

class AuthUser
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
        $response = new ResponseController();

        try {
            $token = $request->header('token');

            $token = base64_decode($token);
            $token = json_decode($token);

            $login_logs = LoginLogs::where('user_id', $token->user_id)
                ->where('token', $token->token)
                ->where('status', 1)->first();
            
            if(!$login_logs){
                return $response->index(0, 200, 'Belum login bro');
            }
            
            $request->user_id = $login_logs->user_id;

            return $next($request);
        } catch (Throwable $error) {
            return $response->index(0, 401, 'Error unauthenticated '. $error->getMessage());
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->level == '1'){
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect('admin/dang-nhap')->with('loi','Tài khoản hoặc mật khẩu không chính xác!');
            }
        }
        else{
            return redirect('admin/dang-nhap');
        }
    }
}

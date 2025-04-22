<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        // Kiểm tra nếu người dùng không có role là admin
        if (!$user || $user->roles[0]->name !== "super_admin" && $user->roles[0]->name !== "staff" ) {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập vào trang admin.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\products;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikProduk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $seller = products::findOrFail($request->id);
        $user = Auth::user();

        if($seller->user_id !== $user->id) {
            return response()->json('Omae wa bukan pemilik produk ini!');
        }

        // return response()->json($user);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\reviews;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikReview
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_reviewer = reviews::findOrFail($request->id)->user_id;

            $user = Auth::user()->id;

                if ($id_reviewer != $user) {
                    return response()->json('INI KOMEN ORANG WOY!');
                }

        return $next($request);
    }
}

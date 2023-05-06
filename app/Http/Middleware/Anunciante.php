<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Anunciante
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
        //Se o usuario não for um anunciante redireciona para a home
        if (!auth()->user()->isAnunciante) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CuerpoSeguridadMiddleware
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
        if (Auth::check()) {    //si está autentificado
            if (auth()->user()->perfil == "CUERPO-SEGURIDAD") {   //si es role es admin

                return $next($request);    //significa continua
            }
        }
        return redirect()->route('home')->with('access', 'Disabled access');
    }
}

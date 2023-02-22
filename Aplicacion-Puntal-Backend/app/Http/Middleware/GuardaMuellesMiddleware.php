<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GuardaMuellesMiddleware {

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {    //si está autentificado
           /*  if (auth()->user()->perfil == "GUARDA-MUELLES") { 

            return $next($request);    //significa continua
            } */

            if (auth()->user()->perfil == "GUARDA-MUELLES" ||                
                auth()->user()->perfil == "GERENCIA-PUERTO" ||
                auth()->user()->perfil == "XUNTA-GALICIA") { 

                return $next($request);    //significa continua
            }
        }
        return redirect()->route('home')->with('access', 'Disabled access - Solo pueden acceder los usuarios con role GUARDA-MUELLES');
    }
}

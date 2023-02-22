<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class XuntaMiddleware {
 
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {    //si está autentificado
            if (auth()->user()->perfil == "XUNTA-GALICIA") {   //si es role es admin

                return $next($request);
            }
        }
        return redirect()->route('home')->with('access', 'Disabled access - Solo pueden acceder los usuarios con role XUNTA-GALICIA');
    }
}

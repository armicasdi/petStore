<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Veterinario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(! Auth::user()->tipo_usuario->cod_tipo_usuario == 2){
            return redirect()->route('noAutorizado');
        }
        return $next($request);
    }
}

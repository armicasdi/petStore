<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check() ) {
//            return redirect('/home');
//        }

        if(Auth::check() && Auth::user()->tipo_usuario->cod_tipo_usuario == 1){
            return redirect()->route('admin.dashboard');
        }elseif(Auth::check() && Auth::user()->tipo_usuario->cod_tipo_usuario == 2){
            return redirect()->route('veterinario.dashboard');
        }elseif(Auth::check() && Auth::user()->tipo_usuario->cod_tipo_usuario == 3){
            return redirect()->route('secretaria.dashboard');
        }elseif(Auth::check() && Auth::user()->tipo_usuario->cod_tipo_usuario == 4){
            return redirect()->route('inventario.dashboard');
        }elseif(Auth::check() && Auth::user()->tipo_usuario->cod_tipo_usuario == 5){
            return redirect()->route('peluqueria.dashboard');
        }

        return $next($request);
    }
}

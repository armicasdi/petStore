<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'usuario';
    }

    public function authenticated(Request $request){

        $usuario = $request->input('usuario');
        $password = $request->input('password');

        if(Auth::attempt(['usuario'=>$usuario, 'password' => $password])){
            if(Auth::user()->is_active){
                if(Auth::user()->tipo_usuario->cod_tipo_usuario == 1){
                    return redirect()->route('admin.dashboard');
                }elseif(Auth::user()->tipo_usuario->cod_tipo_usuario == 2) {
                    return redirect()->route('veterinario.dashboard');
                }elseif(Auth::user()->tipo_usuario->cod_tipo_usuario == 3){
                    return redirect()->route('secretaria.dashboard');
                } elseif(Auth::user()->tipo_usuario->cod_tipo_usuario == 4){
                    return redirect()->route('inventario.dashboard');
                }elseif(Auth::user()->tipo_usuario->cod_tipo_usuario == 5){
                    return redirect()->route('peluqueria.dashboard');
                }
            }else{
                Auth::logout();
                return redirect()->route('perfilBloqueado');
            }
        }else{
            return redirect()->route('login');
        }
    }


}

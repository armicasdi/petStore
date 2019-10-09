<?php


namespace App\Helpers;


use DomainException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;
use UnexpectedValueException;


class JwtAuth
{
    public $key;
    public function __construct()
    {
        $this->key = 'clave$69308';
    }
    public function signup($usuario, $password, $getToken=null){
        $user = User::where(
            array(
                'usuario' => $usuario,
                'password' => $password
            ))->first();
        $signup = false;

        if(is_object($user)) {
            $signup = true;
        }
        if($signup){
            //Token
            $token = array(
                'sub' => $user->id,
                'usuario' => $user->usuario,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'iat' => time(),
                'exp' => time()+(7*24*60*60)

            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));

            if(is_null($getToken)){
                return $jwt;
            }else{
                return $decoded;
            }


        }else{
            //error
            return array('status'=>'error', 'message'=>'Login ha Fallado');
        }
    }

    public function checkToken($jwt, $getIdentity=false){
        $auth = false;

        try{
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        }catch (UnexpectedValueException $e){
            $auth=false;
        }catch (DomainException $e){
            $auth=false;
        }

        if(isset($decode) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity ){
            return $decoded;
        }

        return $auth;

    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        // MANEJO DE EXCEPCIONES EN LA APLICACION
        if($exception instanceof ModelNotFoundException){
            $modelo = strtolower(class_basename($exception->getModel()));
            $mensaje = "No existe ninguna instancia del modelo {$modelo} con el id especificado";
            return \response()->make(view('errors.404Model', compact('mensaje')),404);
        }else if($exception instanceof AuthenticationException){
            return redirect()->route('login');
        }else if($exception instanceof AuthorizationException){
            return \response()->make(view('errors.403'),403);
        } else if($exception instanceof NotFoundHttpException) {
            return \response()->make(view('errors.404'),404);
        } else if($exception instanceof MethodNotAllowedHttpException){
            return \response()->make(view('errors.method'),405);
        }else if($exception instanceof HttpException){
            $mensaje = $exception->getMessage();
            $estado = $exception->getStatusCode();
            return \response()->make(view('errors.http',compact('mensaje')),$estado);
        }else if($exception instanceof QueryException){
            $codigo = $exception->errorInfo[1];
            if($codigo == 1451){
                return \response()->make(view('errors.query'),409);
            }
        }else if(config('app.debug')) {
            return parent::render($request, $exception);
        }
        return \response()->make(view('errors.500'), 500);
//        return parent::render($request, $exception);
    }
}

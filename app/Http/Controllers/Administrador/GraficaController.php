<?php
namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Auth;

class GraficaController extends Controller
{
    public function chartjs()
    {

        $viewer = DB::table('consulta')
        ->select(DB::raw('count(cod_consulta) as cod_count'))
        ->where('estado','=',1)
        ->groupBy(DB::raw('year(fecha)'))
        ->get()->toArray();
        $viewer = array_column($viewer, 'cod_count');

        return view('administrador.grafica')
            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK));

    }

}

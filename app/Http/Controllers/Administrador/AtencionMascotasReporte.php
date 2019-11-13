<?php

namespace App\Http\Controllers\Administrador;

use App\Consulta;
use App\Control_vacunas;
use App\Peluqueria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Auth;
use DateTime;


class atencionMascotasReporte extends Controller
{
    public function index()
    {
        $pagActual = "Reporte de Atencion";
        return view('administrador.atencionReporte', compact('pagActual'));
    }

    public function registro($servicio, $mes, $year)
    {

        if($servicio == "Consulta"){
            $pagActual = "Reporte de Atencion";
            $data = Consulta::whereYear('fecha', '=', $year)
                ->whereMonth('fecha', '=', $mes)
                ->get();
            return view('administrador.registroAtencion', compact('data', 'pagActual'));
        }

        if($servicio == "Peluqueria"){
            $pagActual = "Reporte de Atencion";
            $data = Peluqueria::whereYear('fecha', '=', $year)
                ->whereMonth('fecha', '=', $mes)
                ->get();
            return view('administrador.registroAtencion', compact('data', 'pagActual'));
        }

        if($servicio == "Control_Vacunas"){
            $pagActual = "Reporte de Atencion";
            $data = Control_vacunas::whereYear('fecha', '=', $year)
                ->whereMonth('fecha', '=', $mes)
                ->with('mascota.raza','mascota.propietario','empleados')
                ->get();
            return view('administrador.registroAtencion', compact('data', 'pagActual'));
        }


    }


    public function get_customer_data()
    {

    }

    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        return $pdf->stream();
    }

    function convert_customer_data_to_html()
    {

    }
}

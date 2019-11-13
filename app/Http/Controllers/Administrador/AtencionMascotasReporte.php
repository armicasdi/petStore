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

    public function registro($servicio, $mes, $year, $semana=NULL)
    {
        if (isset($semana)) {
            if ($semana=="all"){
                global $from, $to;
                $from = 1;
                $to = 31;
            }elseif ($semana == 1) {

                $from = 7;
                $to = 1;
            } elseif ($semana == 2) {
                $from = 8;
                $to = 14;
            } elseif ($semana == 3) {
                $from = 15;
                $to = 21;
            } elseif ($semana == 4) {
                $from = 22;
                $to = 31;
            }

             if($servicio == "Consulta"){
                $pagActual = "Reporte de Atencion";
                $data = Consulta::whereYear('fecha', '=', $year)
                    ->whereMonth('fecha', '=', $mes)
                    ->whereDay('fecha', '>=', $from)
                    ->whereDay('fecha', '<=', $to)
                    ->with('mascota.raza','mascota.propietario','empleados')
                    ->get();
                return view('administrador.registroAtencion', compact('data', 'pagActual', 'servicio', 'mes', 'year', 'semana'));
            }

            if($servicio == "Peluqueria"){
                $pagActual = "Reporte de Atencion";
                $data = Peluqueria::whereYear('fecha', '=', $year)
                    ->whereMonth('fecha', '=', $mes)
                    ->whereDay('fecha', '>=', $from)
                    ->whereDay('fecha', '<=', $to)
                    ->with('mascota.raza','mascota.propietario','empleados')
                    ->get();
                return view('administrador.registroAtencion', compact('data', 'pagActual', 'servicio', 'mes', 'year', 'semana'));
            }

            if($servicio == "Control_Vacunas"){
                $pagActual = "Reporte de Atencion";
                $data = Control_vacunas::whereYear('fecha', '=', $year)
                    ->whereMonth('fecha', '=', $mes)
                    ->whereDay('fecha', '>=', $from)
                    ->whereDay('fecha', '<=', $to)
                    ->with('mascota.raza','mascota.propietario','empleados')
                    ->get();
                return view('administrador.registroAtencion', compact('data', 'pagActual', 'servicio', 'mes', 'year', 'semana'));
            }

        }}



    ///Para Registrar el PDF y Descargarlo

    public function registroPdf($servicio, $mes, $year, $semana=NULL)
    {

        if (isset($semana)){
            if($semana == "all"){
                global $from1, $to1;
                $from1 = 1;
                $to1 = 31;
            }elseif($semana==1){
                $from1 = 7;
                $to1 = 1;
            }elseif ($semana ==2){
                $from1=8;
                $to1=14;
            }elseif ($semana==3){
                $from1=15;
                $to1=21;
            }elseif($semana ==4){
                $from1=22;
                $to1=31;
            }

            if($servicio == "Consulta"){
                $pagActual = "Reporte de Atencion";
                $data = Consulta::whereYear('fecha', '=', $year)
                    ->whereMonth('fecha', '=', $mes)
                    ->whereDay('fecha', '>=', $from1)
                    ->whereDay('fecha', '<=', $to1)
                    ->with('mascota.raza','mascota.propietario','empleados')
                    ->get();
                return $data;
            }

            if($servicio == "Peluqueria"){
                $pagActual = "Reporte de Atencion";
                $data = Peluqueria::whereYear('fecha', '=', $year)
                    ->whereMonth('fecha', '=', $mes)
                    ->whereDay('fecha', '>=', $from1)
                    ->whereDay('fecha', '<=', $to1)
                    ->with('mascota.raza','mascota.propietario','empleados')
                    ->get();
                return $data;
            }

            if($servicio == "Control_Vacunas"){
                $pagActual = "Reporte de Atencion";
                $data = Control_vacunas::whereYear('fecha', '=', $year)
                    ->whereMonth('fecha', '=', $mes)
                    ->whereDay('fecha', '>=', $from1)
                    ->whereDay('fecha', '<=', $to1)
                    ->with('mascota.raza','mascota.propietario','empleados')
                    ->get();
                return $data;
            }
        }

           }




    function pdf($servicio, $mes, $year, $semana=NULL)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html($servicio, $mes, $year, $semana));
        return $pdf->stream();
    }

    function convert_customer_data_to_html($servicio, $mes, $year, $semana)
    {
        setlocale(LC_TIME, 'spanish');
        $mes_actual = date('n');
        $dateObj   = DateTime::createFromFormat('!m', $mes_actual);
        $monthName = strftime('%B', $dateObj->getTimestamp());

        $customer_data = $this->registroPdf($servicio, $mes, $year, $semana);

        $output = '
        <h3 align="center">Mascotas generadas en el mes de '. $monthName .' </h3>
        <h3 align="center">Generado: '.date('d-m-Y h:i:s a').' </h3>
        <h3 align="center">Creado por: '.Auth::user()->empleados->nombres.' '.Auth::user()->empleados->apellidos.'</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <th style="border: 1px solid; padding:12px;" width="25%">Cod expediente</th>
        <th style="border: 1px solid; padding:12px;" width="25%">Nombre de la mascota</th>
        <th style="border: 1px solid; padding:12px;" width="25%">Raza</th>
        <th style="border: 1px solid; padding:12px;" width="25%">Fecha de Ingreso</th>
        </tr>
        ';
        foreach($customer_data as $customer)
        {
            $output .= '
        <tr>
        
        
        <td style="border: 1px solid; padding:12px;">'.$customer->cod_expediente.'</td>
        <td style="border: 1px solid; padding:12px;">'.$customer->mascota->nombre.'</td>
        <td style="border: 1px solid; padding:12px;">'.$customer->mascota->raza->raza.'</td>
        <td style="border: 1px solid; padding:12px;">'.date('d-m-Y', strtotime($customer->fecha)).'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        return $output;
    }
}

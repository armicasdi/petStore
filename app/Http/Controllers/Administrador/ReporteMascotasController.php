<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Auth;
use DateTime;
class ReporteMascotasController extends Controller
{
    public function index()
    {
        setlocale(LC_TIME, 'spanish');
        $mes_actual = date('n');
        $dateObj   = DateTime::createFromFormat('!m', $mes_actual);
        $nombre_mes = strftime('%B', $dateObj->getTimestamp());
        $pagActual = "reporteMascotas";
        $customer_data = $this->get_customer_data();
        return view('administrador.reporteMascotas',compact('customer_data','pagActual','nombre_mes'));
    }
    public function get_customer_data()
    {
        $mes = date('n');
        $anio = date('y');
        $time = strtotime($mes.'/01/'.$anio);
        $customer_data = DB::table('mascotas')
        ->select('cod_expediente', 'nombre', 'Color', 'fecha_creacion')
        ->whereBetween(DB::raw('date(fecha_creacion)'), array(date('Y-m-d',$time), date('Y-m-t',$time)))
        ->get();
        return $customer_data;
    }
    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html());
     return $pdf->stream();
    }

    function convert_customer_data_to_html()
    {
        setlocale(LC_TIME, 'spanish');
        $mes_actual = date('n');
        $dateObj   = DateTime::createFromFormat('!m', $mes_actual);
        $monthName = strftime('%B', $dateObj->getTimestamp());


        $customer_data = $this->get_customer_data();



        $output = '
        <img src="../public/img/logo.png" width="75px align="left"><h2 align="center">Mascotas generadas en el mes de '. $monthName .' </h2>
        <p align="left">Generado: '.date('d-m-Y h:i:s a').' </p>
        <p align="rigth">Creado por: '.Auth::user()->empleados->nombres.' '.Auth::user()->empleados->apellidos.'</p>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <th style="border: 1px solid; padding:12px;" width="25%">Numero expediente</th>
        <th style="border: 1px solid; padding:12px;" width="25%">Nombre de la mascota</th>
        <th style="border: 1px solid; padding:12px;" width="25%">Color</th>
        <th style="border: 1px solid; padding:12px;" width="25%">Fecha de creacion</th>
        </tr>
        ';
        foreach($customer_data as $customer)
        {
        $output .= '
        <tr>
        <td style="border: 1px solid; padding:12px;">'.$customer->cod_expediente.'</td>
        <td style="border: 1px solid; padding:12px;">'.$customer->nombre.'</td>
        <td style="border: 1px solid; padding:12px;">'.$customer->Color.'</td>
        <td style="border: 1px solid; padding:12px;">'.$customer->fecha_creacion.'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        return $output;
    }
}

<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Auth;
class DynamicPDFController extends Controller
{
    public function index()
    {
        $pagActual = "reporte";
        $customer_data = $this->get_customer_data();
        return view('administrador.dynamic_pdf',compact('customer_data','pagActual'));
    }
    public function get_customer_data()
    {
        $customer_data = DB::table('productos')
        ->select('nombre', 'precio', 'cantidad')
        ->orderBy('cantidad', 'asc')
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
     $customer_data = $this->get_customer_data();
     $output = '
     <h3 align="center">Productos más vendidos</h3>
     <h3 align="center">Generado: '.date('d-m-Y h:i:s a').' </h3>
     <h3 align="center">Creado por: '.Auth::user()->empleados->nombres.' '.Auth::user()->empleados->apellidos.'</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="40%">Nombre</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Precio</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Cantidad</th>
   </tr>
     ';  
     foreach($customer_data as $customer)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$customer->nombre.'</td>
       <td style="border: 1px solid; padding:12px;">$ '.$customer->precio.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->cantidad.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Regional;
use App\Unidad;
use App\Salida;
use App\Tematica;
use App\Correlativo;
use App\User;
use DB;
use Toastr;
use PDF;

class SelloSalidaController extends Controller
{
    public function index()
    {
        return view('sistema.sellosalida.index');    
    }

    public function listado(){
        $result = DB::table('salidas')
                    ->join('tematicas', 'salidas.idtematica', '=', 'tematicas.id')
                    ->join('unidades', 'salidas.idunidad', '=', 'unidades.id')
                    ->join('regionales', 'salidas.idregional', '=', 'regionales.id')
                    ->where([
                        ['tematicas.estado','=',true],
                        ['unidades.estado','=',true],
                        ['regionales.estado','=',true],
                        ['salidas.estado','=',true],
                    ])
                    ->select(DB::raw("salidas.id,
                            DATE_FORMAT(salidas.fecha_salida, '%d/%m/%Y') AS fecha_salida,
                            salidas.cite_manual,
                            unidades.unidad,
                            regionales.regional,
                            tematicas.tematica,
                            salidas.costo,
                            salidas.cantidad_salida,
                            salidas.total,
                            DATE_FORMAT(salidas.created_at, '%d/%m/%Y %h:%i %p') AS created_at"))
                    ->get()
                    ->toJson();
        return $result;
    }
    
    public function create()
    {
        $unidad = Unidad::where("estado","=",true)->pluck('unidad', 'id');
        $regional = Regional::where("estado","=",true)->pluck('regional', 'id');
        $tematica = Tematica::where("estado","=",true)->pluck('tematica', 'id');
        return view('sistema.sellosalida.create', compact('unidad','regional', 'tematica'));
    }

    public function citeValor($valor){
        if($valor<10)
            return '00000'.$valor;
        if($valor>9 && $valor <100)
            return '0000'.$valor;
        if($valor>99 && $valor<1000)
            return '000'.$valor;
        if($valor>999 && $valor<10000)
            return '00'.$valor;
        if($valor>9999 && $valor<100000)
            return '0'.$valor;
        if($valor>99999)
            return $valor;
    }

    public function store(Request $request)
    {
        try{
            $salida = new Salida($request->all());
            $salida->total = $salida->cantidad_salida * $salida->costo;
            $salida->userid_registra = Auth::user()->id;
            $salida->userid_actualiza = Auth::user()->id;
            $correlativo = DB::table('correlativos')->where([['estado','=',true],['id','=',1]])->get();
            $salida->correlativo = $correlativo[0]->cite.$this->citeValor($correlativo[0]->valor).'/'.$correlativo[0]->gestion;
            if($salida->save()){
                $salidaActualizar = DB::select('CALL SP_ACTUALIZAR_SALIDAS_CORRELATIVO(?,?,?,?)',array($salida->id, $salida->idtematica, $salida->cantidad_salida, 1));
                Toastr::success('Se ha registrado de manera correcta la salida de '.$salida->cantidad_salida.' unidades','Registro de Salida');
            }
        }catch(\Exception $ex){
            Toastr::error('Ocurrio un error: '.$ex->getMessage(), 'Error');
        }
        return redirect()->route('salida.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function reporte(Request $request, $idsalida){
        $salida = Salida::where("id","=",$idsalida)->get();
        $fechaImpresion = 'La Paz, '.date('d').' de '.$this->fecha().' de '.date('Y');
        $view = \View::make('sistema.sellosalida.reporte', compact('fechaImpresion','salida'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('Letter','portrait');
        $pdf->loadHTML($view);
        return $pdf->stream();
    }
    public function fecha(){
        $arrayMes = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        return $arrayMes[(int)(date('m')) - 1];
    }
}

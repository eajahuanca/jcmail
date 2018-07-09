<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tematica;
use App\Ingreso;
use App\Correlativo;
use DB;
use Toastr;

class SelloEntradaController extends Controller
{
    public function index()
    {
        return view('sistema.selloentrada.index');
    }

    public function listado(){
        $result = DB::table('ingresos')
                    ->join('tematicas', 'ingresos.idtematica', '=', 'tematicas.id')
                    ->where('tematicas.estado','=',true)
                    ->where('ingresos.estado','=',true)
                    ->select(DB::raw("ingresos.id,
                            ingresos.cite_ingreso,
                            ingresos.cantidad_actual,
                            ingresos.cantidad_nueva,
                            ingresos.cantidad_total,
                            tematicas.tematica,
                            tematicas.costo,
                            DATE_FORMAT(ingresos.created_at, '%d/%m/%Y %h:%i %p') AS created_at"))
                    ->orderBy('created_at','DESC')
                    ->get()
                    ->toJson();
        return $result;
    }

    public function saldoTematica($idtematica, Request $request){
        if($request->ajax()){
            return DB::table('tematicas')->where('id','=',$idtematica)->get()->toJson();
        }
    }

    public function create()
    {
        $tematica = Tematica::where("estado","=",true)->pluck('tematica', 'id');
        return view('sistema.selloentrada.create', compact('tematica'));
    }
    
    public function store(Request $request)
    {
        try{
            
            $cont = 0;
            $tematica = $request->input('idtematica');
            $actual = $request->input('cantidad_actual');
            $nuevo = $request->input('cantidad_nueva');

            $correlativo = DB::table('correlativos')->where([['estado','=',true],['id','=',2]])->get();
            $cite = $correlativo[0]->cite.' '.$this->citeValor($correlativo[0]->valor).'/'.$correlativo[0]->gestion;
            $correlativo_ = Correlativo::find(2);
            $correlativo_->valor = $correlativo_->valor + 1;
            $correlativo_->save();
    
	        while($cont < count($tematica)){
	            $ingreso = new Ingreso();
	            $ingreso->cite_ingreso = $cite; 
	            $ingreso->idtematica = $tematica[$cont]; 
	            $ingreso->cantidad_actual = $actual[$cont];
	            $ingreso->cantidad_nueva = $nuevo[$cont];
                $ingreso->cantidad_total = $actual[$cont] + $nuevo[$cont];
                $ingreso->userid_registra = Auth::user()->id;
                $ingreso->userid_actualiza = Auth::user()->id;
	            if($ingreso->save()){
                    $cont++;
                    $ingresoActualizar = DB::select('CALL SP_ACTUALIZAR_INGRESOS(?,?,?)', array($ingreso->id, $ingreso->idtematica, $ingreso->cantidad_nueva));
                }   
	        }
            Toastr::success('Se ha registrado un nuevo ingreso', 'Ingreso registrado');
            
        }catch(\Exception $ex){
            Toastr::error('Ocurrio un error: '.$ex->getMessage(),'Error');
        }
        return redirect()->route('entrada.index');
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
}

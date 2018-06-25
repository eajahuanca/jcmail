<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tematica;
use App\Ingreso;
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
                            ingresos.cantidad_nueva,
                            ingresos.cantidad_actual,
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
            $ingreso = new Ingreso($request->all());
            $ingreso->cantidad_total = $ingreso->cantidad_nueva + $ingreso->cantidad_actual;
            $ingreso->userid_registra = Auth::user()->id;
            $ingreso->userid_actualiza = Auth::user()->id;
            if($ingreso->save()){
                Toastr::success('Se ha registrado un nuevo ingreso con : '.$ingreso->cantidad_nueva.' unidades', 'Ingreso registrado');
                $ingresoActualizar = DB::select('CALL SP_ACTUALIZAR_INGRESOS(?,?,?)', array($ingreso->id, $ingreso->idtematica, $ingreso->cantidad_nueva));
            }            
        }catch(\Exception $ex){
            Toastr::error('Ocurrio un error: '.$ex->getMessage(),'Error');
        }
        return redirect()->route('entrada.index');
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

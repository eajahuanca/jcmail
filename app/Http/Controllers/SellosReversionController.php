<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tematica;
use App\User;
use App\Reversion;
use DB;
use Toastr;

class SellosReversionController extends Controller
{
    public function index()
    {
        return view('sistema.selloreversion.index');
    }

    public function listado(){
        $result = DB::table('reversiones')
            ->join('tematicas', 'salidas.idtematica', '=', 'tematicas.id')
            ->where([
                ['tematicas.estado','=',true],
                ['reversiones.estado','=',true],
            ])
            ->select(DB::raw("reversiones.id,
                            DATE_FORMAT(reversiones.fecha_reversion, '%d/%m/%Y') AS fecha_salida,
                            reversiones.cite_manual,
                            tematicas.tematica,
                            reversiones.cantidad_actual,
                            reversiones.cantidad_reversion,
                            reversiones.total,
                            DATE_FORMAT(reversiones.created_at, '%d/%m/%Y %h:%i %p') AS created_at"))
            ->get()
            ->toJson();
        return $result;
    }

    public function create()
    {
        $tematica = Tematica::where("estado","=",true)->pluck('tematica', 'id');
        return view('sistema.selloreversion.create', compact("tematica", $tematica));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $reversion = new Reversion($request->all());
            $reversion->total = $reversion->cantidad_actual + $reversion->cantidad_reversion;
            $reversion->userid_registra = Auth::user()->id;
            $reversion->userid_actualiza = Auth::user()->id;
            if($reversion->save()){
                $reversionActualizar = DB::select('CALL SP_ACTUALIZAR_TEMATICA_REVERSION(?,?)',array($reversion->idtematica, $reversion->cantidad_reversion));
                Toastr::success('Se ha registrado de manera correcta la reversion de '.$reversion->cantidad_reversion.' unidades','Registro de Reversion');
            }
        }catch(\Exception $ex){
            Toastr::error('Ocurrio un error: '.$ex->getMessage(), 'Error');
        }
        return redirect()->route('reversion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

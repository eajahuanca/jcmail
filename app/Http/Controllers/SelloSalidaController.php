<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regional;
use App\Unidad;
use App\Salida;
use App\Tematica;
use App\Correlativo;
use App\User;

class SelloSalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sistema.sellosalida.index');    
    }

    /**
     * Function detail jqxGrid Json Salidas
     */
    public function listado(){
        $result = DB::table('salidas')
                    ->join('tematicas', 'salidas.idtematica', '=', 'tematicas.id')
                    ->join('unidades', 'salidas.idunidad', '=', 'unidades.id')
                    ->join('regionales', 'salidas.idregional', '=', 'regionales.id')
                    ->where([
                        ['tematicas.estado','=',true],
                        ['unidades.estado','=',true],
                        ['regionales.estado','=',true],
                    ])
                    ->select(DB::raw("salidas.id,
                            DATE_FORMAT(salidas.fecha_salida, '%d/%m/%Y') AS fecha_salida
                            salidas.cite_manual,
                            unidades.unidad,
                            regionales.regional,
                            tematicas.tematica,
                            tematicas.costo,
                            salidas.cantidad_actual,
                            salidas.cantidad_salida,
                            salidas.total,
                            DATE_FORMAT(salidas.created_at, '%d/%m/%Y %h:%i %p') AS created_at"))
                    ->get()
                    ->toJson();
        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidad = Unidad::where("estado","=",true)->pluck('unidad', 'id');
        $regional = Regional::where("estado","=",true)->pluck('regional', 'id');
        $tematica = Tematica::where("estado","=",true)->pluck('tematica', 'id');
        return view('sistema.sellosalida.create', compact('unidad','regional', 'tematica'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

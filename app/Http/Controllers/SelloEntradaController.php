<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tematica;
use App\Salida;
use DB;

class SelloEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sistema.selloentrada.index');
    }

    /**
     * Function detail jqxGrid Json Entradas
     */
    public function listado(){
        $result = DB::table('ingresos')
                    ->join('tematicas', 'ingresos.idtematica', '=', 'tematicas.id')
                    ->where('tematicas.estado','=',true)
                    ->select(DB::raw("ingresos.id,
                            ingresos.cantidad_nueva,
                            ingresos.cantidad_actual,
                            ingresos.cantidad_total,
                            tematicas.tematica,
                            tematicas.costo,
                            DATE_FORMAT(ingresos.created_at, '%d/%m/%Y %h:%i %p') AS created_at"))
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
        $tematica = Tematica::where("estado","=",true)->pluck('tematica', 'id');
        return view('sistema.selloentrada.create', compact('tematica'));
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

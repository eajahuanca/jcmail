<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    protected $table = 'tematicas';
    protected $fillable = [
        'id',
        'tematica',
        'saldo_inicial',
        'saldo_actual',
        'costo',
        'userid_actualiza',
        'userid_registra',
        'estado',
        'created_at',
        'updated_at'
    ];

    public function ingresos(){
        return $this->hasMany('App\Ingreso');
    }

    public function salidas(){
        return $this->hasMany('App\Salida');
    }

    public function userregistra(){
        return $this->belongsTo('App\User','userid_registra', 'id');
    }

    public function useractualiza(){
        return $this->belongsTo('App\User','userid_actualiza', 'id');
    }
}

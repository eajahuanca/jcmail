<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable = [
        'id',
        'cantidad_nueva',
        'cantidad_actual',
        'cantidad_total',
        'idtematica',
        'userid_registra',
        'userid_actualiza',
        'created_at',
        'updated_at'
    ];

    public function tematicas(){
        return $this->belongsTo('App\Tematica','idtematica','id');
    }

    public function userregistra(){
        return $this->belongsTo('App\User','userid_registra', 'id');
    }

    public function useractualiza(){
        return $this->belongsTo('App\User','userid_actualiza', 'id');
    }
}

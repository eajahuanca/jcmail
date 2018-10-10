<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table = 'salidas';
    protected $fillable = [
        'id',
        'fecha_salida',
        'cite_manual',
        'idunidad',
        'idregional',
        'idtematica',
        'cantidad_actual',
        'cantidad_salida',
        'costo',
        'total',
        'correlativo',
        'userid_registro',
        'userid_actualiza',
        'created_at',
        'updated_at'
    ];

    public function unidades(){
        return $this->belongsTo('App\Unidad', 'idunidad','id');
    }

    public function regionales(){
        return $this->belongsTo('App\Regional', 'idregional','id');
    }

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

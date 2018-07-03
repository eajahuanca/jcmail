<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reversion extends Model
{
    protected $table = 'reversiones';
    protected $fillable = [
        'id',
        'idtematica',
        'cite_manual',
        'cantidad_actual',
        'cantidad_reversion',
        'total',
        'fecha_reversion',
        'estado',
        'observaciones',
        'userid_registro',
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

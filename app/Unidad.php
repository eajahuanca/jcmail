<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades';
    protected $fillable = [
        'id',
        'unidad',
        'estado',
        'created_at',
        'updated_at'
    ];

    public function regionales(){
        return $this->hasMany('App\Regional');
    }

    public function salidas(){
        return $this->hasMany('App\Salida');
    }
}

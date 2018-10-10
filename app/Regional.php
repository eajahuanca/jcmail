<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'regionales';
    protected $fillable = [
        'id',
        'regional',
        'estado',
        'idunidad',
        'created_at',
        'updated_at'
    ];

    public function unidades(){
        return $this->belongsTo('App\Unidad','idunidad','id');
    }

    public function salidas(){
        return $this->hasMany('App\Salida');
    }
}

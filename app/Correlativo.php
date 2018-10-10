<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlativo extends Model
{
    protected $table = 'correlativos';
    protected $fillable = [
        'id',
        'cite',
        'valor',
        'gestion',
        'descripcion',
        'estado',
        'created_at',
        'updated_at'
    ];
}

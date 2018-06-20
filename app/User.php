<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $fillable = [
                            'id',
                            'us_ci',
                            'us_nombre', 
                            'us_paterno', 
                            'us_materno',
                            'us_genero',
                            'email',
                            'us_cuenta',
                            'us_tipo',
                            'us_estado',
                            'us_obs',
                            'created_at',
                            'updated_at',
                            'us_estadociv',
                            'us_condicion',
                            'us_sueldo',
                            'us_cargo',
                            'us_direccion',
                            'us_unidad'
                        ];

    protected $hidden = [
                            'password',
                            'remember_token',
                        ];

    public function tematicas(){
        return $this->hasMany('App\Tematica');
    }

    public function ingresos(){
        return $this->hasMany('App\Ingreso');
    }

    public function salidas(){
        return $this->hasMany('App\Salida');
    }
}
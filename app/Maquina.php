<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{

    protected $fillable = [
        'id','codigo', 'nombre','estado', 'especificaciones','valor_hora','operadores',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ]; 

    public function maquina_has_operador(){

        return $this->hasMany('App\MaquinaHasOperador', 'maquina_id','id');

    }
    
    
}

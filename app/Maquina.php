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

    public function getCodigoyNombreAttribute()
    {
        return $this->codigo . ': ' . $this->nombre;
    }

    public function proceso_has_maquina(){
        return $this->hasMany('App\ProcesoHasMaquina', 'id', 'maquina_id');
    }

    public function etapaItemOt(){
        return $this->hasMany('App\EtapaItemOt', 'maquina_id', 'id');
    }
    
    
}

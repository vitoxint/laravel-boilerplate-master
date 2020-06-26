<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    protected $fillable = [ 
        'nombre' ,'ubicacion', 'estado_habilitada' , 'estado_utilizada'
    ];

    protected $hidden   = [
        'remember_token'

    ];

    public function existencia_material(){

        return $this->hasMany('App\ExistenciaMaterial', 'deposito_id','id');
        
    }
}

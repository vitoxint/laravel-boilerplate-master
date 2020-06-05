<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaquinaHasOperador extends Model
{
    protected $fillable = [
       'id' ,'maquina_id' , 'empleado_id' , 'maquina' , 'operador'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function operador(){
        return $this->hasOne('App\Empleado', 'id', 'empleado_id');
    }



    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoHasMaquina extends Model
{
    protected $fillable = [
        'id' ,'proceso_id' , 'maquina_id' , 'maquina' , 'proceso'
     ];
 
     protected $hidden = [
         'remember_token'
     ];
 
     public function maquina(){
         return $this->hasOne('App\Maquina', 'id', 'maquina_id');
     }
}

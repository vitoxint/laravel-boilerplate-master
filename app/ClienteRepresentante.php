<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteRepresentante extends Model
{
   protected $fillable = [
        'id', 'nombre','funcion_representante', 'telefono','email','cliente_id','slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    
    public function cliente(){
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }
    
 
}

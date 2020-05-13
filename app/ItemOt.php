<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOt extends Model
{

    protected $fillable = [
        'id','cantidad', 'ot_id', 'folio' ,'valor_unitario','valor_parcial' ,'descripcion','estado','especificaciones','fecha_inicio','fecha_termino'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ]; 
    
    public function folio() {
        return $this->folio;
    }

    public function ordenTrabajo(){
        
        return $this->belongsTo('App\OrdenTrabajo', 'ot_id', 'id');
    }
    
}

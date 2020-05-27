<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCotizacion extends Model
{
    protected $fillable = [
        'folio','cantidad','descripcion','valor_unitario','descuento','valor_parcial','observaciones','cotizacion_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


    public function Cotizacion(){
        
        return $this->belongsTo('App\Cotizacion', 'cotizacion_id', 'id');
    }
}

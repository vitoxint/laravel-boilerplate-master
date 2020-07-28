<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSc extends Model
{
    protected $fillable = [
        'id','sc_id' ,'producto_id', 'cantidad', 'valor_unitario', 'descuento' , 'valor_total'
    ];

    protected $hidden = [
        'remember_token'
    ];


    public function solicitudCotizacion(){
        return $this->belongsTo('App\SolicitudCotizacion' ,'sc_id', 'id');
    }

    public function producto(){
        return $this->belongsTo('App\ProductoVenta', 'producto_id','id');
    }
}

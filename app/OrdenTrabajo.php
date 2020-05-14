<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    protected $fillable = [
        'cliente_id', 'folio', 'representante_id','user_id', 'estado','cotizacion','orden_compra','fecha_inicio','fecha_termino','entrega_estimada',
        'valor_total',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


    public function cliente() {
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }
    
    public function usuario() {
        return $this->belongsTo('App\Models\Auth\User', 'user_id', 'id');
    }

     public function representante() {
        return $this->belongsTo('App\ClienteRepresentante', 'representante_id', 'id');
    }   

    public function items_ot() {
        return $this->hasMany('App\ItemOt', 'ot_id', 'id');
    }  
    
}
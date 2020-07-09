<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoOt extends Model
{
    protected $fillable=[
        'ot_id', 'monto', 'medio_pago', 'cuenta_cliente_id', 'user_id','fecha_abono'
    ];

    protected $hidden=[
        'remember_token'
    ];

    public function ordenTrabajo(){
        return $this->belongsTo('App\OrdenTrabajo', 'ot_id', 'id');
    }

    public function encargado(){
        return $this->hasOne('App\Models\Auth\User', 'id','user_id');
    }

    public function cuentaCliente(){
        return $this->belongsTo('App\CuentaCliente', 'cuenta_cliente_id', 'id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonoCuentaCliente extends Model
{
    protected $fillable = [

        'cuentacl_id', 'user_id', 'monto' , 'fecha_registro', 'medio_pago', 'observaciones'

    ];

    protected $hidden = ['remember_token'];

    public function cuentaCliente(){

        return $this->belongsTo('App\CuentaCliente', 'cuentacl_id', 'id');

    }

    public function encargado(){

        return $this->hasOne('App\Models\Auth\User', 'id','user_id');
    }
}

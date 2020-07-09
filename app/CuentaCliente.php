<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaCliente extends Model
{
    protected $fillable = [

        'cliente_id', 'saldo', 'estado_activa' , 'estado_cuenta', 'nombre'
    ];

    protected $hidden = [ 'remember_token'];

    public function cliente(){

        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');

    }
}

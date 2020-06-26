<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistenciaProductoVenta extends Model
{
    protected $fillable = [
        'producto_id', 'deposito_id' , 'cantidad'

    ];

    protected $hidden   = [
        'remember_token'

    ];

    public function deposito(){
        return $this->belongsTo('App\Deposito' , 'deposito_id' , 'id');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaOt extends Model
{
    protected $fillable = [
        'user_id' , 'receptor' , 'rut_receptor' , 'hora_entrega'  ,'ot_id'
    ];

    protected $hidden = [ 
        'remember_token'
    ];

    public function entregasItemOt(){
        return $this->hasMany('App\EntregaItemOt' ,'entregaot_id', 'id');
    }

    public function encargado(){
        return $this->hasOne('App\Models\Auth\User', 'id','user_id');
    }


}

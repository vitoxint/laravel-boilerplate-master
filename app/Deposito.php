<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    protected $fillable = [ 
        'nombre' ,'ubicacion', 'estado_habilitada' , 'estado_utilizada'
    ];

    protected $hidden   = [
        'remember_token'

    ];
}

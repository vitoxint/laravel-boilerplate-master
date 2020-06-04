<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{

    protected $fillable = [
        'id','codigo', 'nombre','estado', 'especificaciones'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ]; 
    
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{

    protected $fillable = [
        'codigo', 'descripcion', 'maquinas'
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

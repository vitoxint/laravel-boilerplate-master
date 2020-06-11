<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable= [
        'codigo','perfil','sistema_medida','diam_exterior' , 'diam_interior', 'espesor', 'densidad',  'valor_kg',
    ];

    protected $hidden = [
        'remember_token'
    ];
}
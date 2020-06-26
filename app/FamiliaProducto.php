<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamiliaProducto extends Model
{
    protected $fillable = [
        'nombre'
    ];

    protected $hidden = [
        'remember_token'
    ];
}

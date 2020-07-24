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

    public function producto_ventas(){
        return $this->hasMany('App\ProductoVenta' , 'familia_producto_id' ,'id');
    }

}

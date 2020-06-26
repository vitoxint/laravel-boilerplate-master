<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoVenta extends Model
{
    
    protected $fillable = [

        'codigo' , 'descripcion' , 'marca_id' , 'familia_producto_id' , 'imagen_url' , 'procedencia' , 'precio_lista' , 'stock_seguridad' , 'exixtencias'

    ];

    protected $hidden = [

        'remember_token'

    ];

    public function marca(){
        return $this->belongsTo('App\Marca', 'marca_id', 'id');
    }

    public function familia(){
        return $this->belongsTo('App\FamiliaProducto', 'familia_producto_id', 'id');
    }

    public function existencias(){
        return $this->hasMany('App\ExistenciaProductoVenta',  'producto_id' ,'id');
    }

}

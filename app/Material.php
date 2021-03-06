<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable= [
        'codigo','perfil','sistema_medida','diam_exterior' , 'diam_interior', 'espesor', 'densidad',  'valor_kg', 'proveedor', 'tipo_corte','material','dimensionado'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function existenciaMaterial(){
        return $this->hasMany('App\ExistenciaMaterial', 'material_id', 'id');
    }
}

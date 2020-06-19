<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistenciaMaterial extends Model
{
    protected $fillable =[
        'material_id', 'deposito_id', 'dimension_largo', 'dimension_ancho', 'valor_unit', 'valor_total', 'estado_consumo', 'origen_material' , 'detalle_origen'
        ,'user_id'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function material(){
        return $this->belongsTo('App\Material', 'material_id', 'id');
    }

    public function deposito(){
        return $this->belongsTo('App\Deposito', 'deposito_id', 'id');
    }
}

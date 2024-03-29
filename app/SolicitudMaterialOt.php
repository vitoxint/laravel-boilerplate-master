<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudMaterialOt extends Model
{
   protected $fillable = [
        'material_id', 'itemot_id' , 'dimension_largo' , 'dimension_ancho' , 'valor_unit', 'valor_total' ,'material' , 'materialOt' , 'estado' ];
        //estados : 1 , en espera, 2 respondida , 3 cerrada

   protected $hidden = [
       'remember_token'
   ];

   public function materialOt(){
       return $this->belongsTo('App\ItemOt','itemot_id', 'id');
   }

   public function material(){
       return $this->belongsTo('App\Material','material_id', 'id');
   }
}

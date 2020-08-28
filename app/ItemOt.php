<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOt extends Model
{

    protected $fillable = [
        'id','cantidad', 'ot_id', 'folio' ,'valor_unitario','valor_parcial' ,'descripcion','estado','especificaciones','fecha_inicio','fecha_termino'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ]; 
    
    public function folio() {
        return $this->folio;
    }

    public function ordenTrabajo(){        
        return $this->belongsTo('App\OrdenTrabajo', 'ot_id', 'id');
    }

    public function imagenes(){
        return $this->hasMany('App\ImagenItemOt','itemot_id','id');
    }

    public function procesosOt(){
        return $this->hasMany('App\EtapaItemOt', 'itemot_id', 'id');
    }

    public function avanceItemOt(){
        $terminados = EtapaItemOt::where('itemot_id','=',$this->id)->where('estado_avance','=',4)->count();
        $totales = EtapaItemOt::where('itemot_id','=',$this->id)->count();

        return $terminados.' de ' . $totales;
    }

    public function porcentajeAvanceItemOt(){
        $terminados = EtapaItemOt::where('itemot_id','=',$this->id)->where('estado_avance','=',4)->count();
        $totales = EtapaItemOt::where('itemot_id','=',$this->id)->count();

        $porcentaje = ($terminados/$totales)*100;

        return round($porcentaje);
    }

    public function materialOt(){
        return $this->hasMany('App\TrabajoUseMaterial', 'itemot_id', 'id');
    }
    
    public function solicitudMaterialOt(){
        return $this->hasMany('App\SolicitudMaterialOt', 'itemot_id', 'id')->where('estado','=',1);
    }


    
}

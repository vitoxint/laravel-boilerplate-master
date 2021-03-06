<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtapaItemOt extends Model
{
    protected $fillable =[
        'itemot_id','proceso_id','maquina_id' ,'empleado_id', 'detalle', 'estado_avance', 'tiempo_asignado','tiempo_real,','fh_inicio', 'fh_termino' , 'fh_limite','codigo',
        'valor_unitario', 'cantidad','valor_proceso'
    ];

    protected $hidden= [
        'remember_token'
    ];

    public function itemOt(){
        return $this->belongsTo('App\ItemOt', 'itemot_id' , 'id');
    }

    public function proceso(){
        return $this->hasOne('App\Proceso', 'id', 'proceso_id');
    }

    public function maquina(){
        return $this->hasOne('App\Maquina', 'id' ,'maquina_id');
    }

    public function operador(){
        return $this->hasOne('App\Empleado', 'id', 'empleado_id');
    }


}

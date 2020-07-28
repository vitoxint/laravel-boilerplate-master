<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudCotizacion extends Model
{
    
    protected $fillable = [
        'id', 'nombre_solicitante', 'email_solicitante', 'telefono_solicitante', 'mensaje', 'estado' , 'valor_total', 'user_id','mensaje_respuesta','validez',
        'fecha_envio'
    ];

    protected $hidden = ['remember_token'];

    public function usuario(){
        return $this->belongsTo('App\Models\Auth\User', 'user_id', 'id');
    }

    public function itemsSolicitud(){
        return $this->hasMany('App\ItemSc', 'sc_id' , 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    
    protected $fillable = [
        'folio','empresa','contacto','telefono_contacto','email_contacto','valor_neto', 'dias_validez','estado','observaciones','created_at','user_id','user','forma_pago','condicion_pago'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    public function items_cotizacion() {
        return $this->hasMany('App\ItemCotizacion', 'cotizacion_id', 'id');
    }  

    public function usuario() {
        return $this->belongsTo('App\Models\Auth\User', 'user_id', 'id');
    }


}

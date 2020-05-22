<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    
    protected $fillable = [
        'folio','empresa','contacto','telefono_contacto','email_contacto','dias_validez','estado','observaciones','created_at','user_id','user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


}

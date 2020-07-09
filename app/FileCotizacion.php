<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileCotizacion extends Model
{

    protected $fillable = [
        'url','cotizacion_id','extension','size','image_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


    public function cotizacion(){
        return $this->belongsTo('App\Cotizacion' , 'cotizacion_id','id');
    }

    public function getUrlPathAttribute(){
        return \Storage::url($this->url);
    }
}

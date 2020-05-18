<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenItemOt extends Model
{

    protected $fillable = [
        'url','itemot_id','ot_id','extension','size','image_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


    public function item(){
        return $this->belongsTo('App\ItemOt' , 'itemot_id','id');
    }

    public function getUrlPathAttribute(){
        return \Storage::url($this->url);
    }

}

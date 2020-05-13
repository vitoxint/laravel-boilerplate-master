<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{

    protected $fillable = [
        'name','region_id','region',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    public function Region(){
        return $this->belongsTo('App\Region', 'region_id', 'id');
    }

}

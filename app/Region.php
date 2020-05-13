<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = [
        'name','ordinal',
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

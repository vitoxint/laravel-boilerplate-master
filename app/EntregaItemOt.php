<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaItemOt extends Model
{
    protected $fillable = [ 'entregaot_id', 'itemot_id'];

    protected $hidden   = ['remember_token'];

    public function item_ot(){
        return $this->belongsTo('App\ItemOt', 'itemot_id', 'id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable =[
        'codigo','rut','nombres', 'apellidos', 'ocupacion', 'user_id', 'usuario','estado_activo'

    ];

    protected $hidden = [

        'remember_token',
    ];

    public function usuario(){
        return $this->hasOne('App\Models\Auth\User', 'user_id', 'id');
    }
}

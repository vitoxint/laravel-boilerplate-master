<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use DB;

class Cliente extends Model
{
    
    use HasSlug;

    protected $fillable = [
        'rut_cliente', 'razon_social', 'telefono','celular','email','direccion','region','commune', 'region_id', 'commune_id', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];
    
    public function getRazonSocial() {
        return $this->razon_social;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('razon_social')
            ->saveSlugsTo('slug')
            ->usingSeparator('-')
            ->allowDuplicateSlugs();
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function commune(){
        return $this->belongsTo('App\Commune', 'commune_id', 'id');
    }   

    public function contactos(){
        return $this->hasMany('App\ClienteRepresentante', 'cliente_id', 'id');
    } 




    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table='animales';
    public $timestamps = false;
    protected $primaryKey = 'id_animal';



    public function especies(){
    	return $this->hasMany('App\Especie');
    }


    public function zoologicos(){
    	return $this->hasMany('App\Zoologico');
    }
}

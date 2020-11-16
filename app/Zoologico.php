<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zoologico extends Model
{
    protected $table='zoologicos';

     public function animal(){
    	return $this->belongsTo('App\Animal');
    }

}

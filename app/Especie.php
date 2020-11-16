<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table='especies';


    public function animal(){
    	return $this->belongsTo('App\Animal');
    }
}

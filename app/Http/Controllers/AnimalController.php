<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use DB;
class AnimalController extends Controller
{
    public function store(Request $request){
    	$animal = new Animal();
    	$animal->especie_id = $request->especie_id;
    	$animal->zoologico_id = $request->zoologico_id;
    	$animal->num_identificacion=$request->num_identificacion;
    	$animal->sexo=$request->sexo;
    	$animal->anio_nacimiento=$request->anio_nacimiento;
    	$animal->pais_origen=$request->pais_origen;
    	$animal->continente=$request->continente;
    	$animal->save();
    	return $animal;

	}
	
	public function show($num_identificacion){   
		$animal=DB::table('animales')
					->join('especies', 'animales.especie_id', '=', 'especies.id_especie')
					->join('zoologicos', 'animales.zoologico_id', '=', 'zoologicos.id_zoologico')
					->where('animales.num_identificacion', '=', $num_identificacion)
					->get();
		return $animal;
		
	}   

	public function index(){
        $animales=DB::table('animales')
					->join('especies', 'animales.especie_id', '=', 'especies.id_especie')
					->select('animales.num_identificacion', 'especies.nombre_vulgar', 'animales.sexo', 'animales.pais_origen',
								'animales.anio_nacimiento','animales.continente', 'animales.id_animal')
					->get();
		return $animales;
	}
	



	public function update(Request $request, $num_identificacion){
		$id = DB::table('animales')->where('num_identificacion', $num_identificacion)->value('id_animal');
		print "foo es $id";
		$animal = Animal::find($id);
		$animal->sexo=$request->sexo;
    	$animal->anio_nacimiento=$request->anio_nacimiento;
    	$animal->pais_origen=$request->pais_origen;
    	$animal->continente=$request->continente;
		$animal->save();
		return $animal;
	}


	public function destroy($id){
		DB::table('animales')->where('num_identificacion', '=', $id)->delete();
	}
}
